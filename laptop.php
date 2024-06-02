<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Repair</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <?php include 'include/navbar.php'; ?>


    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            color: #555;
            margin: 0;
        }
        a {
            color: #666;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #BB2C54;
        }
        .center-items {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }
        hr {
            background: #fff;
            height: 2px;
            border: 0;
            background-image: -webkit-gradient(linear, 0 0, 100% 0, from(#fff), to(#fff), color-stop(50%, #e6e6e6));
            background-image: -webkit-linear-gradient(left, #fff, #e6e6e6, #fff);
            background-image: -moz-linear-gradient(left, #fff, #e6e6e6, #fff);
            background-image: -ms-linear-gradient(left, #fff, #e6e6e6, #fff);
            background-image: -o-linear-gradient(left, #fff, #e6e6e6, #fff);
            clear: both;
        }
        hr:after {
            content: '';
            background: #ccc;
            display: block;
            height: 1px;
            background-image: -webkit-gradient(linear, 0 0, 100% 0, from(#e6e6e6), to(#e6e6e6), color-stop(50%, #ccc));
            background-image: -webkit-linear-gradient(left, #e6e6e6, #ccc, #e6e6e6);
            background-image: -moz-linear-gradient(left, #e6e6e6, #ccc, #e6e6e6);
            background-image: -ms-linear-gradient(left, #e6e6e6, #ccc, #e6e6e6);
            background-image: -o-linear-gradient(left, #e6e6e6, #ccc, #e6e6e6);
        }
        #contenuto {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 10px;
        }
        #contenuto:hover {
            transform: translateY(-5px);
        }
        .col {
            width: calc(33.33% - 20px);
            margin: 0 10px;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        @media only screen and (max-width: 767px) {
            .col {
                width: calc(50% - 20px);
                margin: 0 10px;
            }
        }
        @media only screen and (max-width: 480px) {
            .col {
                width: calc(100% - 20px);
                margin: 0 10px;
            }
        }
         </style>
</head>
<body>

    <div class="center-items">
        <img src="nn.png">
      </div>
      </section>
      <div class="row">
      <section id="contenuto">
        <div class="col">
          <h1>Expert Repairs </h1>
          <p>Trust your laptop with our team of skilled technicians for quick and reliable repairs. From hardware issues to software glitches, we've got you covered.</p>
        </div>
    
        <div class="col">
          <h1>Thorough Cleaning </h1>
          <p>Give your laptop a fresh start with our professional cleaning service. We'll remove dust, dirt, and grime to improve performance and extend its lifespan.</p>
        </div>
    
        <div class="col">
          <h1> Upgrades </h1>
          <p>Boost your laptop's performance with our upgrade solutions. Whether it's upgrading RAM, SSD, or installing the latest software, we'll tailor solutions to meet your needs.</p>
        </div>
    </section>



    <?php include 'include/footer.php'; ?>
    <script src="script.js"></SCript>

    
</body>
</html>
