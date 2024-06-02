<?php

include_once "../include/conn.php";

// Check if the user ID is provided via POST request
if(isset($_POST['userId'])) {
    // Get the user ID from the POST data
    $userId = $_POST['userId'];

    try {
        // Prepare and execute the SQL query to fetch user data
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);

        // Fetch user data as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user data is found
        if($user) {
            // Return user data as JSON response
            echo json_encode($user);
        } else {
            // User not found, return empty JSON object
            echo json_encode([]);
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Return error if user ID is not provided
    echo json_encode(['error' => 'User ID not provided']);
}
?>
