<?php
include_once "../include/conn.php";
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_username'])) {
    // Redirect to the 404 access denied page
    header("Location: 403.php");
    exit();
}


// Query to get the count of users
$stmtUser = $pdo->query("SELECT COUNT(*) as user_count FROM users");
$userCount = $stmtUser->fetchColumn(); // Fetch the count of users

// Check if the query was successful
if ($userCount !== false) {
    // Display the number of users
    $userCountHTML = "<p>$userCount<br/><span>Number of Users</span></p>";
} else {
    // Display an error message if the query fails
    $userCountHTML = "<p>Error fetching user count</p>";
}

// Query to get the count of products
$stmtProduct = $pdo->query("SELECT COUNT(*) as product_count FROM products");
$productCount = $stmtProduct->fetchColumn(); // Fetch the count of products

// Check if the query was successful
if ($productCount !== false) {
    // Display the number of products
    $productCountHTML = "<p>$productCount<br/><span>Number of Products</span></p>";
} else {
    // Display an error message if the query fails
    $productCountHTML = "<p>Error fetching product count</p>";
}

// Query to get the count of orders
$stmtOrder = $pdo->query("SELECT COUNT(*) as order_count FROM order_list");
$orderCount = $stmtOrder->fetchColumn(); // Fetch the count of orders

// Check if the query was successful
if ($orderCount !== false) {
    // Display the number of orders
    $orderCountHTML = "<p>$orderCount<br/><span>Number of Orders</span></p>";
} else {
    // Display an error message if the query fails
    $orderCountHTML = "<p>Error fetching order count</p>";
}

// Query to get the total income from orders
$stmtIncome = $pdo->query("SELECT SUM(total) AS total_income FROM order_list");
$totalIncome = $stmtIncome->fetchColumn(); // Fetch the total income

// Check if the query was successful
if ($totalIncome !== false) {
    // Display the total income
    $totalIncomeHTML = "<p>₱$totalIncome<br/><span>Total Income</span></p>";
} else {
    // Display an error message if the query fails
    $totalIncomeHTML = "<p>Error fetching total income</p>";
}

$currentHour = date('H');
$currentMinute = date('i');

// Query to get the monthly revenue
$stmtMonthlyRevenue = $pdo->query("SELECT DATE_FORMAT(date_ordered, '%M') AS month, SUM(total) AS revenue FROM order_list GROUP BY DATE_FORMAT(date_ordered, '%Y%m') ORDER BY DATE_FORMAT(date_ordered, '%m')");
$monthlyRevenueData = $stmtMonthlyRevenue->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="adminpanel.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="manage_product.css">

    <?php include_once 'sidenav.php'; ?>
</head>
<body>
<div id="main">
    <div class="head">
        <div class="nav-toggle">
            <span style="font-size:30px;cursor:pointer; color: white;" class="nav">☰ Dashboard</span>
            <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Dashboard</span>
        </div>
        <div class="profile">
            <img src="avatar.png" class="pro-img"/>
            <p>Administrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
            <div class="profile-div">
                <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div class="col-div-3">
        <div class="box">
            <?php echo $userCountHTML; ?>
            <i class="fa fa-users box-icon"></i>
        </div>
    </div>
    <div class="col-div-3">
        <div class="box">
            <?php echo $productCountHTML; ?>
            <i class="fa fa-list box-icon"></i>
        </div>
    </div>
    <div class="col-div-3">
        <div class="box">
            <?php echo $orderCountHTML; ?>
            <i class="fa fa-shopping-bag box-icon"></i>
        </div>
    </div>
    <div class="col-div-3">
        <div class="box">
            <?php echo $totalIncomeHTML; ?>
            <i class="fas fa-money-bill-alt box-icon"></i>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/><br/>
    <div class="col-lg-8">
        <!-- Monthly Revenue Bar Chart -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-bar-chart"></i> Monthly Revenue
            </div>
            <div class="card-body">
                <canvas id="monthlyRevenueChart" width="100" height="50"></canvas>
            </div>
            <?php
            date_default_timezone_set('Asia/Manila');

            $footerText = '';

            // Check if the current time is after 11:59 PM
            if ($currentHour >= 23 && $currentMinute >= 59) {
                // Generate footer text for the last update at 11:59 PM
                $footerText = 'Last updated at 11:59 PM';
            } else {
                // Generate initial footer text with the current date and time
                $footerText = 'Updated ' . date('F j, Y \a\t g:i A');
            }
            ?>
                
            <div class="card-footer small text-muted"><?php echo $footerText; ?></div>
            </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="adminpanel.js"></script>

<script>
    // Monthly Revenue Data
    const monthlyRevenueData = <?php echo json_encode($monthlyRevenueData); ?>;

    // Extracting month names and revenue values
    const months = monthlyRevenueData.map(data => data.month);
    const revenues = monthlyRevenueData.map(data => data.revenue);

    // Get the canvas element
    const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');

    // Create the chart
    const monthlyRevenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenue',
                data: revenues,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Toggle Profile Dropdown
    $('.dots').on('click', function() {
        $('.profile-div').toggle();
    });
</script>
</body>
</html>
