<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addOrder"])) {
   
    include_once "../include/conn.php";

    // Retrieve form data
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $dateOrdered = $_POST['dateOrdered'];
    $paymentStatus = $_POST['paymentStatus'];
    $total = $_POST['total'];
    $paymentMethod = $_POST['paymentMethod'];
    $orderStatus = $_POST['orderStatus'];

    // Prepare and execute the query to insert the new order into the database
    $stmt = $pdo->prepare("INSERT INTO order_list (username, address, phone, date_ordered, payment_status, total, payment_method, order_status) VALUES (:username, :address, :phone, :dateOrdered, :paymentStatus, :total, :paymentMethod, :orderStatus)");
    $stmt->execute(array(
        ':username' => $username,
        ':address' => $address,
        ':phone' => $phone,
        ':dateOrdered' => $dateOrdered,
        ':paymentStatus' => $paymentStatus,
        ':total' => $total,
        ':paymentMethod' => $paymentMethod,
        ':orderStatus' => $orderStatus
    ));

    if ($stmt->rowCount() > 0) {

        header("Location: orderlist.php");
        exit;
    } else {

        echo "Failed to add order. Please try again.";
    }
}
?>
