<?php
// Include necessary files and initialize the session
include_once "include/conn.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Get the user ID
$userId = $_SESSION['user_id'];

// Retrieve data from the order_list table for the specific user
$stmt = $pdo->prepare("SELECT id, total, DATE(date_ordered) AS date_ordered, payment_status, payment_method, order_status, product_name, quantity FROM order_list WHERE client_id = ?");
$stmt->execute([$userId]); // Fixed here, replaced $client_id with $userId
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <?php include_once "include/conn.php"; ?>
    <?php include 'include/navbar.php'; ?>

    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            background-color: white;
        }

        .text-center {
            color: black;
        }

        .order {
            margin-bottom: 20px;
            padding: 15px;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            background-color: #fff;
            text-align: center;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .order h2 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 26px;
            color: #343a40;
        }

        .order p {
            margin: 0;
            color: #6c757d;
            font-size: 20px;
            line-height: 1.5;
        }

        .order p strong {
            color: #343a40;
            font-weight: bold;
        }

        .status-ordered {
            color: #ffc107;
            font-weight: bold;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        /* Search and Filter Styles */
        .search-filter-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-input {
            width: 70%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .filter-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .filter-btn:hover {
            background-color: #0056b3;
        }

        .buy-again-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #381c24; /* Green color */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .buy-again-btn:hover {
            background-color: #321920; /* Darker green color on hover */
        }


        @media (max-width: 768px) {
            .search-input {
                width: 100%;
            }
        }

        /* Added border around items */
        .order {
            border: 2px solid #dee2e6;
            border-radius: 10px;
        }

        /* Added border box for order columns */
        .order-columns {
            padding: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Order Status</h1>
    <!-- Filter Buttons -->
    <div class="search-filter-container">
        <div class="filter-container">
        <button class="filter-btn all-btn" onclick="filterByStatus('all')">ALL</button>
        <button class="filter-btn processing-btn" onclick="filterByStatus('processing')">Processing</button>
        <button class="filter-btn delivered-btn" onclick="filterByStatus('delivered')">Delivered</button>
        <button class="filter-btn cancelled-btn" onclick="filterByStatus('cancelled')">Cancelled</button>
        </div>
    </div>
    <!-- End Filter Buttons -->

    <!-- Search -->
    <div class="search-filter-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Search..." onkeyup="searchOrders()">
    </div>
    <!-- End Search -->

    <!-- Border box for order columns -->
    <div class="order-columns">
    <div class="row">
        <?php
        // Retrieve data from the order_list table for the logged-in user
        $stmt = $pdo->prepare("SELECT id, total, DATE(date_ordered) AS date_ordered, payment_status, payment_method, order_status, product_name, quantity FROM order_list WHERE client_id = ?");
        $stmt->execute([$userId]);

        // Check if there are any orders
        if ($stmt->rowCount() > 0) {
            // Output data of each row
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Separate product names and quantities
                $productNames = explode(',', $row['product_name']);
                $quantities = explode(',', $row['quantity']);
                ?>
                <div class="col-md-4">
                    <div class="order">
                        <h2>Order #<?php echo $row['id']; ?></h2>
                        <p>Total: ₱<?php echo $row['total']; ?></p>
                        <p>Date Ordered: <?php echo $row['date_ordered']; ?></p>
                        <p>Product Name: <?php echo implode(", ", $productNames); ?></p> <!-- Display product names -->
                        <p>Quantity: <?php echo implode(", ", $quantities); ?></p> <!-- Display quantities -->
                        <p>Payment Status: <?php echo $row['payment_status']; ?></p>
                        <p>Payment Method: <?php echo $row['payment_method']; ?></p>
                        <p>Order Status: <span class="status-ordered"><?php echo $row['order_status']; ?></span></p>
                        <?php if ($row['order_status'] === 'cancelled') { ?>
                            <button class="buy-again-btn" onclick="buyAgain(<?php echo $row['id']; ?>)">Buy Again</button>
                        <?php } else { ?>
                            <button class="cancel-btn" onclick="cancelOrder(<?php echo $row['id']; ?>)">Cancel Order</button>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</div>
</div>


<?php include 'include/footer.php'; ?>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    // Function to filter orders by status
    function filterByStatus(status) {
        var orders = document.getElementsByClassName('order');

        for (var i = 0; i < orders.length; i++) {
            var order = orders[i];
            var orderStatus = order.getElementsByClassName('status-ordered')[0].innerText.toLowerCase();

            // Check if order status matches the selected status or if 'all' is selected
            if (status === 'all' || orderStatus === status) {
                order.style.display = "";
            } else {
                order.style.display = "none";
            }
        }
    }

    // Function to search orders by order number or product name
    function searchOrders() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var orders = document.getElementsByClassName('order');

    for (var i = 0; i < orders.length; i++) {
        var order = orders[i];
        var orderId = order.getElementsByTagName('h2')[0].innerText.toLowerCase();
        var productName = order.getElementsByTagName('p')[2].innerText.toLowerCase(); // Get product name
        
        // Check if order number or product name contains the search input
        if (orderId.indexOf(input) > -1 || productName.indexOf(input) > -1) {
            order.style.display = "";
        } else {
            order.style.display = "none";
        }
    }
}

    // Function to cancel an order
    function cancelOrder(orderId) {
        // Show confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to cancel this order?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to update order status
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Update order status visually
                            var orderElement = document.querySelector('.order h2:contains("' + orderId + '")').parentNode;
                            orderElement.querySelector('.status-ordered').innerText = 'cancelled';
                            Swal.fire({
                                title: 'Cancelled!',
                                text: 'Your order has been cancelled.',
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to cancel the order.',
                                icon: 'error'
                            });
                        }
                    }
                };
                xhr.open('POST', 'cancel_order.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('orderId=' + orderId);
            }
        });
    }

    function buyAgain(orderId) {
    // Here you can perform any actions you want when the user clicks "Buy Again"
    // For example, you can redirect the user to a page where they can reorder the items.
    alert("Buy Again: Order #" + orderId);
}


</script>

</body>
</html>
