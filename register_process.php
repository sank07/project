
<?php
// Include the database connection
require_once 'db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $mobile = htmlspecialchars(trim($_POST['mobile']));

    // Validate form data
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields except mobile are required.");
    }
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    try {
        $sql = "INSERT INTO users (name, email, password, mobile) VALUES (:name, :email, :password, :mobile)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashed_password,
            ':mobile' => $mobile
        ]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            die("Email already exists.");
        } else {
            die("Error: " . $e->getMessage());
        }
    }
}
?>
