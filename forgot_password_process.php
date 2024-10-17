<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect the user to a page to update their password
        header("Location: update_password.php?email=$email");
    } else {
        echo "No account found with this email.";
    }
}
?>
