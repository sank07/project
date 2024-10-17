


<?php
require 'auth_check.php';
//session_start(); // Start the session to access user information

// Database connection
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM products LIMIT 6"; // Fetch 6 products for 3x2 grid
$result = $conn->query($sql);

// Get the username from the session if logged in
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: #333;
            padding: 10px;
            color: white;
        }
        nav a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            gap: 20px;
            padding: 20px;
        }
        .product {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .product p {
            margin: 5px 0;
        }
        .product form {
            margin-top: 10px;
        }
        .product input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .product input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <nav>
    <h1>Available Products</h1>
    </nav>

    

    <div class="products">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<h2>" . htmlspecialchars($row['product_name']) . "</h2>"; // Updated field name
                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['product_name']) . "'>"; // Updated field name
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<p>Price: " . htmlspecialchars($row['price']) . "</p>";
                echo "<p>Stock: " . htmlspecialchars($row['stock']) . "</p>"; // Assuming stock is in DB
                echo "<form action='buy_product.php' method='POST'>";
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($row['id']) . "'>";
                echo "<input type='submit' value='Buy'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No products available.";
        }
        ?>
    </div>

</body>
</html>
