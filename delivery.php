<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <?php include 'include/navbar.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #212428;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          
            
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            line-height: 1.6;
            color: #CCCCCC;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 20px;
            color: #FFFFFF;
            margin-bottom: 10px;
        }
        .highlight {
            color: #007bff;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>



    <div class="container">
        <h1>Delivery Information</h1>
        <div class="section">
            <p class="section-title">1. Delivery Options</p>
            <p>We offer <span class="highlight">standard delivery</span> exclusively serving Laguna areas, which typically takes 1-2 business days. In addition, we provide the convenience of in-store pickup.
               You can also choose <span class="highlight">in-store pickup</span> option.</p>
        </div>
        <div class="section">
            <p class="section-title">2. Delivery Coverage</p>
            <p>Our delivery services are tailored to cover the entirety of Laguna. Please note that we solely cater to addresses within this area, ensuring efficient and prompt service.</p>
        </div>
        <div class="section">
            <p class="section-title">3. Delivery Charges</p>
            <p>Delivery charges are  <span class="highlight">FREE</span></p>
        </div>
        <div class="section">
            <p class="section-title">4. Tracking Your Order</p>
            <p>Once your order has been processed, you will be able to see the status in your "My Purchase" section. We will also contact you using the phone number you provided for further updates.</p>
        </div>
        <div class="section">
            <p class="section-title">5. Delivery Process</p>
            <p>I will contact you to schedule delivery at a convenient time. Please ensure someone is available to receive the package.</p>
        </div>
        <div class="section">
            <p class="section-title">6. Delivery Restrictions</p>
            <p>Restrictions may apply to certain products such as oversized items or products with restricted shipping regulations.</p>
        </div>
        <div class="section">
            <p class="section-title">7. Returns and Exchanges</p>
            <p>If you are not satisfied with your purchase or if the product arrives in a damaged condition, please contact us immediately. We apologize for any inconvenience caused and will promptly assist you in resolving the issue.</p>
        </div>
        <div class="section">
            <p class="section-title">8. Customer Support</p>
            <p>Contact us through our  <a href="contact.php" style="color: blue;">Contact Details </a> or message us on Messenger for assistance. Just click the widget to get started.</p>
        </div>
        <div class="section" style="text-align: center;">
            <a href="shop.php" class="button">Back to Shop</a>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>

</body>
</html>
