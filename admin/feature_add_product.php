<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once "../include/conn.php";

    // Process form data
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];
    $productDescription = $_POST['productDescription'];

    // Upload product image
    $targetDir = "../feature_products/";
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["productImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            // Insert product data into the database
            $sql = "INSERT INTO feature_products (product_name, product_price, stock, description, product_img) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$productName, $productPrice, $productStock, $productDescription, basename($_FILES["productImage"]["name"])])) {
                // Redirect to the appropriate page
                header("Location: manage_featureproduct.php");
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
