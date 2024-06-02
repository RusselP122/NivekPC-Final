<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once "../include/conn.php";
    
    // Process form data
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productDescription = $_POST['productDescription'];
    $productCategory = $_POST['productCategory']; // New line to get the product category
    
    // Upload product image
    $targetDir = "../shop_product/"; 
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["productImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            // Insert product data into the database
            $sql = "INSERT INTO products (product_name, product_price, stock, description, product_img, category) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$productName, $productPrice, $productStock, $productDescription, basename($_FILES["productImage"]["name"]), $productCategory])) {
                // Redirect to the appropriate page
                header("Location: manage_product.php");
                exit;
            } else {
                echo "Error inserting product into database.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
