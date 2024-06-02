<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "include/conn.php";

$cartItems = [];

// Check if 'cart_data' is set in the URL parameter
if (isset($_GET['cart_data'])) {
    // Attempt to unserialize the cart data
    $cartItems = unserialize(urldecode($_GET['cart_data']));
    if ($cartItems === false) {
        // Handle the case where cart data is invalid
        echo "Error: Invalid cart data.";
        exit();
    }
} else {
    // Handle the case where cart data is not found
    echo "Error: Cart data not found.";
    exit();
}


// Function to calculate the subtotal
function calculateSubtotal($cartItems) {
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

$address = "";
$phone = "";

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT username, address, phone FROM users WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    $username = $userDetails['username'];
    $address = $userDetails['address'];
    $phone = $userDetails['phone'];

    $_SESSION['username'] = $username;
    $_SESSION['address'] = $address;
    $_SESSION['phone'] = $phone;

    if (!isset($_SESSION['client_id'])) {
        $_SESSION['client_id'] = $_SESSION['user_id'];
    }
}

function insertOrder($pdo, $client_id, $username, $address, $phone, $cartItems, $paymentMethod) {
    $stmtOrder = $pdo->prepare("INSERT INTO order_list (client_id, username, address, phone, date_ordered, payment_status, total, payment_method, order_status, date_created, date_updated, product_name, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtDelete = $pdo->prepare("DELETE FROM cart_items");

    $dateOrdered = date('Y-m-d H:i:s');
    $subtotal = calculateSubtotal($cartItems);

    foreach ($cartItems as $item) {
        $productName = $item['product_name'];
        $quantity = $item['quantity'];
        $stmtOrder->execute([$client_id, $username, $address, $phone, $dateOrdered, 'pending', $subtotal, $paymentMethod, 'processing', $dateOrdered, $dateOrdered, $productName, $quantity]);
    }

    unset($_SESSION['cart_data']);
    $stmtDelete->execute();

    echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Thank you!",
                    text: "Your order has been placed successfully.",
                    icon: "success",
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    window.location.href = "cart.php?order_placed=true";
                });
            }, 1000);
          </script>';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (isset($_POST['payment_method'])) {
        $paymentMethod = $_POST['payment_method'];
        $client_id = $_SESSION['client_id'];
        insertOrder($pdo, $client_id, $username, $address, $phone, $cartItems, $paymentMethod);
    } else {
        // Payment method not selected, redirect back to checkout page with cart data
        $cartData = urlencode(serialize($cartItems));
        header("Location: checkout.php?error=payment_method_not_selected&cart_data=$cartData");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="checkout.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Style adjustments for better layout */
        .order-table {
            max-height: 300px;
            overflow-y: auto;
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

        .swal2-close {
            color: #4CAF50;
            font-size: 1.5em;
        }

        .swal2-container.swal2-backdrop-show {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .swal2-popup {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            border: 2px solid #4CAF50;
        }
    </style>
</head>
<body>
    <?php include 'include/navbar.php'; ?>

    <div class="container">
        <div class="title">
            <h2>Checkout</h2>
        </div>
        <div class="d-flex">
            <form method="post">
                <?php if (isset($_SESSION['user_id'])): ?>
                <label>
                    <span>Username</span>
                    <input type="text" name="username" placeholder="Your username" value="<?php echo $_SESSION['username']; ?>" readonly>
                </label>
                <?php endif; ?>
                <label>
                    <span>Address <span class="required">*</span></span>
                    <input type="text" name="address" placeholder="House number and street name" required value="<?php echo $address; ?>" readonly>
                </label>
                <label>
                    <span>Phone <span class="required">*</span></span>
                    <input type="tel" name="phone" required value="<?php echo $phone; ?>" readonly> 
                </label>
            </form>
            <div class="Yorder">
                <table class="order-table">
                    <tr>
                        <th colspan="2">Your order</th>
                    </tr>
                    <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?php echo $item['product_name']; ?> x <?php echo $item['quantity']; ?> (Qty)</td>
                        <td>₱ <?php echo $item['price']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>Subtotal</td>
                        <td>₱ <?php echo calculateSubtotal($cartItems); ?></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Free shipping</td>
                    </tr>
                </table><br>
                <form method="post" onsubmit="return validatePaymentMethod()">
                    <div>
                        <input type="radio" name="payment_method" value="cod"> Cash on Delivery
                    </div>
                    <div>
                        <input type="radio" name="payment_method" value="gcash" id="gcash_radio" disabled> Gcash 
                        <img src="https://safehouse.com.ph/images/pay-with-gcash-v2.png" alt="" width="50">
                        (in development)
                    </div>
                    <button type="submit" name="place_order">Place Order</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>

    <script>
        // You can remove the JavaScript function if not needed
        // It was used previously to process payment methods, but now the PHP functions handle that logic
        // You can use JavaScript for client-side validation or other purposes as needed
        function placeOrder() {
            // Submit the form to process the order
            document.querySelector('form').submit();
        }
        function validatePaymentMethod() {
    var paymentMethod = document.querySelector('input[name="payment_method"]:checked');
    if (!paymentMethod) {
        // Display SweetAlert for error: payment method not selected
        Swal.fire({
            title: "Error!",
            text: "Please select a payment method.",
            icon: "error",
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 3000 // 3 seconds
        }).then(() => {
            // Stay on the current page
        });
        return false; // Prevent form submission
    }
    return true; // Allow form submission if payment method is selected
}

    </script>
</body>
</html>
