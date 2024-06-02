<?php

include_once "include/conn.php";
session_start();


if(isset($_POST['productId'])) {
    // Sanitize the productId to prevent SQL injection
    $productId = $_POST['productId'];

    // Prepare a SQL statement to delete the item from the cart_items table
    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
    // Bind the productId parameter to the SQL statement
    $stmt->execute([$productId]);

    // Check if the deletion was successful
    if($stmt->rowCount() > 0) {
        
        echo "Item removed successfully";
    } else {
        
        echo "Error: Item not found or already removed";
    }
} else {
    
    echo "Error: ProductId not provided";
}
?>
