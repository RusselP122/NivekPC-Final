<?php
session_start(); 
include_once "include/conn.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"]; 
    $password = $_POST["password"];

    // Query to check if the user exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if (!$user) {
        // User does not exist
        $_SESSION['email_error'] = "Email not found"; 
        header("Location: account.php"); 
        exit();
    } else {
        // User exists, verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set the session and redirect
            $_SESSION['email'] = $email; // Set the session variable
            
            // Store user_id in session
            $_SESSION['user_id'] = $user['user_id']; //  'user_id' is the column name in  users table
            
            header("Location: index.php");
            exit();
        } else {
            
            $_SESSION['password_error'] = "Incorrect password"; 
            header("Location: account.php"); 
            exit();
        }
    }
}
?>
