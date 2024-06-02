<?php

include_once "include/conn.php";


session_start();


if(isset($_SESSION['user_id'])) {
    // Fetch cart items count from the database
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM cart_items WHERE client_id = ?");
    $stmt->execute([$userId]);
    $count = $stmt->fetchColumn();

    
    echo $count;
} else {
    
    echo 0;
}
?>
