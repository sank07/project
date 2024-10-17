<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="forgot_password_process.php" method="POST">
            <label for="email">Enter your email address:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
