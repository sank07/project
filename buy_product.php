<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the product ID from the form submission
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} else {
    die('No product selected.');
}

// Include the database connection
require_once 'db_connect.php';

// Fetch product details from the database
try {
    $sql = "SELECT * FROM products WHERE id = :product_id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die('Product not found.');
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .product-name {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Buy <span class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></span></h1>
        
        <form action="process_purchase.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="mobile">Mobile Number:</label>
            <input type="text" name="mobile" id="mobile" required>

            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>

            <label for="pin">PIN:</label>
            <input type="text" name="pin" id="pin" required>

            <button type="submit">Buy</button>
        </form>
    </div>
</body>
</html>
