<?php

include_once "../include/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productDescription = $_POST['productDescription'];

    try {
        // Check if a new file was uploaded
        if(isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            // Define the directory path where you want to store the images
            $uploadDirectory = "../feature_products/";

            // Get the file name
            $fileName = basename($_FILES['productImage']['name']);

            // Move the uploaded file to the destination directory
            if(move_uploaded_file($_FILES['productImage']['tmp_name'], $uploadDirectory . $fileName)) {
                // Update the database record with the new image filename
                $stmt = $pdo->prepare("UPDATE feature_products SET product_name = :productName, product_price = :productPrice, stock = :productStock, description = :productDescription, product_img = :productImage WHERE product_id = :productId");
                $stmt->execute(['productName' => $productName, 'productPrice' => $productPrice, 'productStock' => $productStock, 'productDescription' => $productDescription, 'productImage' => $fileName, 'productId' => $productId]);
            } else {
                // Handle the case if file upload failed
                header("Location: manage_featureproduct.php?status=file_error");
                exit();
            }
        } else {
            // If no new file was uploaded, update the database record without changing the image
            $stmt = $pdo->prepare("UPDATE feature_products SET product_name = :productName, product_price = :productPrice, stock = :productStock, description = :productDescription WHERE product_id = :productId");
            $stmt->execute(['productName' => $productName, 'productPrice' => $productPrice, 'productStock' => $productStock, 'productDescription' => $productDescription, 'productId' => $productId]);
        }

        // Redirect back to the page with a success message
        header("Location: manage_featureproduct.php?status=success");
        exit();
    } catch (PDOException $e) {
        // Redirect back to the page with an error message if the update fails
        header("Location: manage_featureproduct.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
