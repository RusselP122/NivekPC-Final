<?php
include_once "include/conn.php"; 
session_start(); 

if(isset($_POST['update'])) {
    // Retrieve new values from the form
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];

    
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; //  user_id is stored in session
    } else {
        
        
        echo "User ID not found. Please log in again.";
        exit; 
    }

    // Validate the data 
    if(!empty($newUsername) && !empty($newEmail) && !empty($newPhone)) {
        // Update the database
        $sql = "UPDATE users SET username=?, email=?, phone=? WHERE user_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newUsername, $newEmail, $newPhone, $user_id]); //  $user_id is the user's ID
        
        // Check if the update was successful
        if($stmt->rowCount() > 0) {
            // Update successful
            echo "Account updated successfully!";
            header("Location: index.php"); 
        } else {
            
            echo "Failed to update account. Please try again.";
        }
    } else {
        
        echo "Please fill in all fields.";
    }
}

?>
