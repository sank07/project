<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Include the database connection
require_once 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $product_id = $_POST['product_id'];
    $name = htmlspecialchars(trim($_POST['name']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $address = htmlspecialchars(trim($_POST['address']));
    $pin = htmlspecialchars(trim($_POST['pin']));

    // Validate form data
    if (empty($name) || empty($mobile) || empty($address) || empty($pin)) {
        die('All fields are required.');
    }

    // Insert order into the database (assuming you have an 'orders' table)
    try {
        $sql = "INSERT INTO orders (user_id, product_id, name, mobile, address, pin) 
                VALUES (:user_id, :product_id, :name, :mobile, :address, :pin)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $_SESSION['user_id'],
            ':product_id' => $product_id,
            ':name' => $name,
            ':mobile' => $mobile,
            ':address' => $address,
            ':pin' => $pin
        ]);

        // Success message
        echo "Purchase successful!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
