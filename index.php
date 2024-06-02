
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">
    <title>Nivek PC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <?php

include_once "include/conn.php";





// Fetch product data from the database
$stmt = $pdo->query("SELECT * FROM feature_products");
$feature_products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

    <?php include 'include/navbar.php'; ?>
    
    <style>
        a {
    text-decoration: none; 
}

.swal2-popup {
    font-size: 1.2em;
}

.swal2-title {
    font-size: 1.5em;
}

.swal2-content {
    font-size: 1.2em;
}

.swal2-icon {
    font-size: 3em;
}

.swal2-timer-progress-bar {
    background-color: #4CAF50; 
}

.swal2-icon-success {
    color: #4CAF50; 
}


</style>

<?php
    // Check if user is logged in and display SweetAlert only if it hasn't been shown before
    if(isset($_SESSION['email']) && !isset($_SESSION['alert_shown'])) {
        echo "<script>
                Swal.fire({
                    title: 'Logged in successfully!',
                    text: 'Welcome to our website Enjoy shopping!',
                    icon: 'success',
                    timer: 3000, // 3 seconds
                    timerProgressBar: true,
                    showConfirmButton: false // Hide the 'OK' button
                });
              </script>";
        
        // Set flag in session to indicate that alert has been shown
        $_SESSION['alert_shown'] = true;
    }
    ?>


</head>
<body>
    

    <section id="hero">
        <h4>Best Deals In Town!</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with vouchers & up to 30% off! </p>
        <button><a href="shop.php">Shop Now</a></button>
    </section>

    <section id="feature" class="section-p2">
        <div class="fe-box">
            <img src="images/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>

        <div class="fe-box">
            <img src="images/f2.png" alt="">
            <h6>Online Order</h6>
        </div>

        <div class="fe-box">
            <img src="images/f3.png" alt="">
            <h6>Save Money</h6>
        </div>

        <div class="fe-box">
            <img src="images/f4.png" alt="">
            <h6>Installment</h6>
        </div>

        <div class="fe-box">
            <img src="images/f5.png" alt="">
            <h6>Fast Transaction</h6>
        </div>

        <div class="fe-box">
            <img src="images/f6.png" alt="">
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modern Design</p>
    <div class="pro-container">
        <?php
        // Fetch and loop through featured product data to display each product
        foreach ($feature_products as $product) {
            echo '<div class="pro">';
            echo '<a href="sfproduct.php?id=' . $product['product_id'] . '">';
            echo '<img src="feature_products/' . $product['product_img'] . '" alt="' . $product['product_name'] . '">';
            echo '<div class="des">';
            echo '<span>' . $product['product_name'] . '</span>';
            
            // Truncate description to 50 characters and add ellipsis if longer
            $short_description = strlen($product['description']) > 50 ? substr($product['description'], 0, 50) . '...' : $product['description'];
            
            echo '<h5>' . $short_description . '</h5>'; // Display truncated description
            echo '<h4>₱ ' . $product['product_price'] . '</h4>';
            echo '</div>';
            echo '<a href="sfproduct.php?id=' . $product['product_id'] . '"><i class="bi-cart-plus cart"></i></a>';
            echo '</div>';
        }
        
        // Check if there's a new product and display it
        if(isset($newProduct)) {
            echo '<div class="pro">';
            echo '<a href="sfproduct.php?id=' . $newProduct['product_id'] . '">';
            echo '<img src="feature_products/' . $newProduct['product_img'] . '" alt="' . $newProduct['product_name'] . '">';
            echo '<div class="des">';
            echo '<span>' . $newProduct['product_name'] . '</span>';
            
            // Truncate description for the new product
            $short_new_description = strlen($newProduct['description']) > 50 ? substr($newProduct['description'], 0, 50) . '...' : $newProduct['description'];
            
            echo '<h5>' . $short_new_description . '</h5>'; // Display truncated description
            echo '<h4>₱ ' . $newProduct['product_price'] . '</h4>';
            echo '</div>';
            echo '<a href="sfproduct.php?id=' . $newProduct['product_id'] . '"><i class="bi-cart-plus cart"></i></a>';
            echo '</div>';
        }
        ?>
    </div>
</section>




<section id="banner" class="section-m1">
    <h4>Repair Services </h4>
    <h2><span>24/7</span> Assistance - Fast and Reliable Repair</h2>
    <button class="normal">Explore More</button>
</section> 

<section id="product1" class="section-p1">
    <h2>New Arrivals</h2>
    <p>For a Better Gaming Experience</p>
    <div class="pro-container">
        <?php
        // Fetch product data from the new_arrivals table
        $stmt = $pdo->query("SELECT * FROM new_arrivals");
        $new_arrivals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $displayed = 0; 
        
        // Loop through product data to display each product
        foreach ($new_arrivals as $product) {
            // Display the product as a new arrival
            echo '<div class="pro">';
            echo '<a href="sanproduct.php?id=' . $product['product_id'] . '">';
            echo '<img src="new_arrival/' . $product['product_img'] . '" alt="' . $product['product_name'] . '">';
            echo '<div class="des">';
            echo '<span>' . $product['product_name'] . '</span>';
            
            // Truncate description to 50 characters and add ellipsis if longer
            $short_description = strlen($product['description']) > 50 ? substr($product['description'], 0, 50) . '...' : $product['description'];
            
            echo '<h5>' . $short_description . '</h5>'; // Display truncated description
            echo '<h4>₱ ' . $product['product_price'] . '</h4>';
            echo '</div>';
            echo '<a href="sanproduct.php?id=' . $product['product_id'] . '"><i class="bi-cart-plus cart"></i></a>';
            echo '</div>';

            $displayed++; 
        }
        ?>
    </div>
</section>


    <?php include 'include/footer.php'; ?>

    <script src="script.js"></SCript>

    <script>

    function signUpForUpdates() {
        // Get the email input field value
        var emailInput = document.querySelector('#newsletter .form input[type="text"]');
        var email = emailInput.value;

        // You can add validation here if needed

        // Perform form submission or AJAX request to sign up the user for updates
        // For demonstration purposes, let's just log the email to the console
        console.log("Signed up for updates with email: " + email);

        // Optionally, you can reset the form after submission
        emailInput.value = '';
    }

    // Store flag in localStorage to prevent SweetAlert from popping up again after refreshing
    if(localStorage.getItem('alertShown')) {
        localStorage.removeItem('alertShown');
    }
    else {
        localStorage.setItem('alertShown', 'true');
    }
</script>

</body>
</html>

