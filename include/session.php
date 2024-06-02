<?php
include 'include/conn.php';
session_start();


if(isset($_SESSION['user'])){
    try {
        // Establish a database connection using the Database class
        $pdo = new Database();
        $conn = $pdo->open();

        // Prepare and execute the SQL query to fetch user information
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id'=>$_SESSION['user']]);
        $user = $stmt->fetch();

        // Close the database connection
        $pdo->close();
    } catch(PDOException $e) {
        // Handle any database connection errors
        echo "There was an error: " . $e->getMessage();
        // You might want to redirect the user or display a friendly error message instead
    }
}
?>


