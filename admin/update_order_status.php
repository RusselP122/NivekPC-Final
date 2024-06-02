<?php
include_once "../include/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderId"])) {
    // Sanitize the input
    $orderId = filter_var($_POST["orderId"], FILTER_SANITIZE_NUMBER_INT);
    $newUsername = isset($_POST["newUsername"]) ? $_POST["newUsername"] : null;
    $newAddress = isset($_POST["newAddress"]) ? $_POST["newAddress"] : null;
    $newPhone = isset($_POST["newPhone"]) ? $_POST["newPhone"] : null;
    $newDateOrdered = isset($_POST["newDateOrdered"]) ? $_POST["newDateOrdered"] : null;
    $newPaymentStatus = isset($_POST["newPaymentStatus"]) ? $_POST["newPaymentStatus"] : null;
    $newTotal = isset($_POST["newTotal"]) ? $_POST["newTotal"] : null;
    $newPaymentMethod = isset($_POST["newPaymentMethod"]) ? $_POST["newPaymentMethod"] : null;
    $newOrderStatus = isset($_POST["newOrderStatus"]) ? $_POST["newOrderStatus"] : null;

    try {
        // Prepare and execute the query
        $sql = "UPDATE order_list 
                SET username = :newUsername, 
                    address = :newAddress, 
                    phone = :newPhone, 
                    date_ordered = :newDateOrdered, 
                    payment_status = :newPaymentStatus, 
                    total = :newTotal, 
                    payment_method = :newPaymentMethod, 
                    order_status = :newOrderStatus 
                WHERE id = :orderId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
        $stmt->bindParam(':newAddress', $newAddress, PDO::PARAM_STR);
        $stmt->bindParam(':newPhone', $newPhone, PDO::PARAM_STR);
        $stmt->bindParam(':newDateOrdered', $newDateOrdered, PDO::PARAM_STR);
        $stmt->bindParam(':newPaymentStatus', $newPaymentStatus, PDO::PARAM_STR);
        $stmt->bindParam(':newTotal', $newTotal, PDO::PARAM_STR);
        $stmt->bindParam(':newPaymentMethod', $newPaymentMethod, PDO::PARAM_STR);
        $stmt->bindParam(':newOrderStatus', $newOrderStatus, PDO::PARAM_STR);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->execute();

        // Check if any rows were affected
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            echo json_encode(array('success' => 'Order updated successfully'));
        } else {
            echo json_encode(array('error' => 'No order found with the provided ID'));
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
    }
} else {
    // Handle invalid request
    echo json_encode(array('error' => 'Invalid request'));
}
?>
