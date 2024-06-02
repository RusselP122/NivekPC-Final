

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <?php include_once "include/conn.php"; ?>
    <?php include 'include/navbar.php'; ?>

    <section id="page-header" class="about-header">
        <h2>#AboutUs</h2>
        <p>Things to know about us</p>
    </section>

    <section id="about-head" class="section-p2">
        <img src="images/a6.jpg" alt="">
        <div>
            <h2>Who We Are?</h2>
            <!-- Fetch and display About Us content from the database -->
            <?php
            if ($pdo) {
              
                try {
                    // Prepare and execute a query
                    $stmt = $pdo->query("SELECT about_us FROM system_info WHERE id = 1");
                    
                 
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                    // Output the about us content after decoding HTML entities
                    echo htmlspecialchars_decode($row['about_us']);
                } catch (PDOException $e) {
                    // Handle any errors
                    echo "Error: " . $e->getMessage();
                }
            } else {
                // Handle connection failure
                echo "Database connection failed.";
            }
            ?>
            <abbr title="" class="head">"Unlocking Possibilities, One Byte at a Time!"</abbr>
            <br><br>
            <marquee style="background-color: hsl(228, 8%, 70%);" loop="-1" scrollamount="5" width="100%">Thank you for choosing Niver PC Repair as your go-to destination for all your computer needs. Start exploring our collection today and elevate your digital experience!</marquee>
        </div>
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



  <?php include 'include/footer.php'; ?>


    <script src="script.js"></SCript>
</body>
</html>