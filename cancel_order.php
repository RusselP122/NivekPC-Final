<?php
// Include database connection
include_once "include/conn.php";

// Check if orderId is set and not empty
if (isset($_POST['orderId']) && !empty($_POST['orderId'])) {
    // Sanitize orderId to prevent SQL injection
    $orderId = filter_var($_POST['orderId'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare update query to set order status as cancelled
    $stmt = $pdo->prepare("UPDATE order_list SET order_status = 'cancelled' WHERE id = :orderId");

    // Bind parameter values
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        // Return success response
        http_response_code(200);
        echo "Order cancelled successfully.";
    } else {
        // Return error response
        http_response_code(500);
        echo "Error: Failed to cancel the order.";
    }
} else {
    // Return error response if orderId is not set or empty
    http_response_code(400);
    echo "Error: orderId parameter is missing or empty.";
}
?>
