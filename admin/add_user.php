<?php

include_once "../include/conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepare and execute the SQL insert query
    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, address) VALUES (:username, :email, :phone, :address)");
        
        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        
        // Execute the query
        $stmt->execute();
        
        header("Location: users.php?status=success");
        exit();
    } catch (PDOException $e) {

        header("Location: users.php?status=error");
        exit();
    }
}
?>