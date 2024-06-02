<?php
// Check if the request method is POST and if product_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {

    include_once "../include/conn.php";

    // Sanitize the input (assuming product_id is an integer)
    $productId = filter_var($_POST["product_id"], FILTER_SANITIZE_NUMBER_INT);

    try {
        // Prepare and execute the query to delete the product from the database
        $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = :productId");
        $stmt->execute(array(':productId' => $productId));

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            // Return a success message 
            echo "Product deleted successfully.";
        } else {
            // Return an error message if the product was not found or could not be deleted 
            echo "Product not found or could not be deleted.";
        }
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error deleting product: " . $e->getMessage();
    }
} else {
    // Return an error message if product_id is not set or request method is not POST 
    echo "Invalid request.";
}
?>
