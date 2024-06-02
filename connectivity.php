<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectivity Services</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <?php include 'include/navbar.php'; ?>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #211f24;
            color: white;
        }
        .container {
            border-radius: 10px;
            box-shadow: 10px 10px 19px #1c1e22, -10px -10px 19px #262a2e;
            padding: 20px;
            margin-top: 30px;
        }
        h2, h3 {
            font-weight: 700;
            margin-bottom: 20px;
        }
        ul, ol {
            margin-left: 20px;
        }
        .features, .service-packages, .how-it-works {
            margin-bottom: 30px;
        }
        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }
            h2 {
                font-size: 1.2rem;
            }
            h3 {
                font-size: 1.1rem;
            }
            ul, ol {
                margin-left: 10px;
            }
        }
        @media (max-width: 400px) {
            .container {
                padding: 10px;
            }
            h2 {
                font-size: 1rem;
            }
            h3 {
                font-size: 0.9rem;
            }
            ul, ol {
                margin-left: 5px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Connectivity Solutions</h2>
    <div class="features">
        <h3>Benefits:</h3>
        <ul>
            <li>Improved efficiency and productivity</li>
            <li>Convenient access to support</li>
            <li>Customized service packages</li>
        </ul>
    </div>
    <div class="service-packages">
        <h3>Service Packages</h3>
        <p>We offer:</p>
        <ul>
            <li>Basic Package: Individuals and small businesses</li>
            <li>Advanced Package: Medium to large enterprises</li>
            <li>Custom Package: Tailored services</li>
        </ul>
    </div>
    <div class="how-it-works">
        <h3>How It Works</h3>
        <ol>
            <li>Contact us to discuss your needs</li>
            <li>We'll assess and recommend solutions</li>
            <li>Efficient implementation</li>
            <li>Ongoing support and maintenance</li>
        </ol>
    </div>
</div>

<?php include 'include/footer.php'; ?>

<script src="script.js"></script>

</body>
</html>
