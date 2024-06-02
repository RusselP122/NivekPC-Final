<?php
// Check if the request method is POST and if orderId is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderId"])) {

    include_once "../include/conn.php";

    // Sanitize the input (assuming orderId is an integer)
    $orderId = filter_var($_POST["orderId"], FILTER_SANITIZE_NUMBER_INT);

    try {
        // Prepare and execute the query to delete the order from the database
        $stmt = $pdo->prepare("DELETE FROM order_list WHERE id = :orderId");
        $stmt->execute(array(':orderId' => $orderId));

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            // Return a success message 
            echo "Order deleted successfully.";
        } else {
            // Return an error message if the order was not found 
            echo "Order not found or could not be deleted.";
        }
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error deleting order: " . $e->getMessage();
    }
} else {
    // Return an error message if orderId is not set or request method is not POST 
    echo "Invalid request.";
}
?>
