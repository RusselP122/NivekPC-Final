<?php
include_once "../include/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if logo update is requested
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
        $logo_tmp_name = $_FILES["logo"]["tmp_name"];
        $logo_name = $_FILES["logo"]["name"];
        
        // Move uploaded file to  directory
        if (move_uploaded_file($logo_tmp_name, $_SERVER['DOCUMENT_ROOT'] . "/NivekPC/" . $logo_name)) {
            // Update logo filename in the database
            $logo_filename = $logo_name; 
            $stmt = $pdo->prepare("UPDATE system_info SET logo = :logo WHERE id = 1");
            $stmt->bindParam(':logo', $logo_filename);
            
            // Execute the SQL statement
            if ($stmt->execute()) {
                // Output debugging information
                echo "Logo filename updated successfully: " . $logo_filename;
            } else {
                // Error handling: Database update failed
                echo "Failed to update logo filename in the database.";
            }
        } else {
            // Error handling: Failed to move uploaded file
            echo "Failed to move uploaded file.";
        }
    }

    // Check if "About Us" content update is requested
    if (isset($_POST['about_us'])) {
        // Retrieve the updated "About Us" content from the form
        $new_about_us_content = $_POST['about_us'];
        
        // Update the "About Us" content in the database
        try {
            $stmt = $pdo->prepare("UPDATE system_info SET about_us = :about_us WHERE id = 1");
            $stmt->bindParam(':about_us', $new_about_us_content);
            
            if ($stmt->execute()) {
                // Output debugging information
                echo "About Us content updated successfully.";
            } else {
                echo "Failed to update About Us content in the database.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

// Check if "Contacts" update is requested
if (isset($_POST['contacts'])) {
    // Retrieve the updated "Contacts" content from the form
    $new_contacts_content = $_POST['contacts'];

    //  Trumbowyg editor might add some HTML tags, let's strip them for safety
    $new_contacts_content = strip_tags($new_contacts_content);

    // Update the "Contacts" content in the database
    try {
        $stmt = $pdo->prepare("UPDATE system_info SET contacts = :contacts WHERE id = 1");
        $stmt->bindParam(':contacts', $new_contacts_content);

        if ($stmt->execute()) {
            // Output debugging information
            echo "Contacts content updated successfully.<br>";
        } else {
            echo "Failed to update Contacts content in the database.<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
    // Redirect back to setting.php
    header("Location: setting.php");
    exit();
}
?>
