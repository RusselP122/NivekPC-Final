<?php

include_once "../include/conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepare and execute the SQL update query
    try {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, phone = :phone, address = :address WHERE user_id = :userId");
        $stmt->execute(['username' => $username, 'email' => $email, 'phone' => $phone, 'address' => $address, 'userId' => $userId]);
        
        // Redirect back to the page with a success message
        header("Location: users.php?status=success");
        exit();
    } catch (PDOException $e) {
        // Redirect back to the page with an error message if the update fails
        header("Location: users.php?status=error");
        exit();
    }
}
?>
