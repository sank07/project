<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update the password for the given email
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $newPassword, $email);
    if ($stmt->execute()) {
        echo "Password updated successfully!";
    } else {
        echo "Failed to update password.";
    }
} else {
    // Display the email field and password reset form
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    } else {
        die("No email provided.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .reset-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .message {
            font-size: 14px;
            color: #777;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Reset Password for <?php echo htmlspecialchars($email); ?></h2>
        <form action="" method="POST">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label for="password">Enter your new password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Update Password">
        </form>
        <p class="message">Make sure your new password is strong and secure!</p>
    </div>
</body>
</html>
