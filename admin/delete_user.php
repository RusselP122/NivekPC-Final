<?php

include_once "../include/conn.php";

// Check if userId is set
if (isset($_POST['userId'])) {
    // Get the userId
    $userId = $_POST['userId'];

    // Prepare and execute the SQL delete query
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :userId");
        $stmt->execute(['userId' => $userId]);
        
        // Return a success message
        echo 'User deleted successfully';
    } catch (PDOException $e) {
        // Display the error message
        echo "Error: " . $e->getMessage();
    }
}
?>