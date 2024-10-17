<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <form action="register_process.php" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile">
            
            <input type="submit" value="Register">
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
