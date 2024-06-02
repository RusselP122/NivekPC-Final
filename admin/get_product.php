<?php

include_once "../include/conn.php";

// Check if productId is set in the POST request
if (isset($_POST['productId'])) {
    // Sanitize the input to prevent SQL injection
    $productId = htmlspecialchars($_POST['productId']);

    // Prepare and execute the SQL query to fetch the product data
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$productId]);

    // Fetch the product data as an associative array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if product data was found
    if ($product) {
        // Return the product data as JSON
        echo json_encode($product);
    } else {
        // Return an error message if the product was not found
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    // Return an error message if productId is not set in the request
    echo json_encode(['error' => 'Product ID not provided']);
}
?>
