<?php
// Start the session
session_start();

// Include the database connection
require_once 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Validate form data
    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    // Check if the user exists
    try {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];

                // Redirect to the product list or dashboard page
                header('Location: index.php');
                exit;
            } else {
                die("Invalid password.");
            }
        } else {
            die("No account found with that email.");
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
