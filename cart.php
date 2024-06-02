<?php
session_start(); // Start or resume the session
include_once "include/conn.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Get the user ID
$userId = $_SESSION['user_id'];


// Retrieve cart items associated with the user's ID from the database
$stmt = $pdo->prepare("SELECT * FROM cart_items WHERE client_id = ?");
$stmt->execute([$userId]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Function to calculate the subtotal
function calculateSubtotal($cartItems) {
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

// Function to calculate the total
function calculateTotal($subtotal) {
    // For simplicity,  shipping is free
    return $subtotal;
}

// Calculate subtotal and total
$subtotal = calculateSubtotal($cartItems);
$total = calculateTotal($subtotal);

// Serialize the cart items array and pass it as a URL parameter
$cartData = urlencode(serialize($cartItems));

// Check if the cart is empty
$isEmpty = empty($cartItems);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Nivek PC</title>
</head>
<body>

<style>  

.remove-button {
    background-color: transparent; 
    color: white; 
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

#empty-cart-message {
    text-align: center;
    padding: 20px;
    margin-top: 20px;
}

.empty-cart-content {
    margin-bottom: 30px;
    border: 0;
    transition: all .3s ease;
    letter-spacing: .5px;
    border-radius: 8px;
    box-shadow: 1px 5px 24px 0 rgba(68,102,242,.05);
}

.empty-cart-content h3 {
    color: #333;
    font-size: 28px;
    margin-bottom: 10px;
}

.empty-cart-content h4 {
    color: #666;
    font-size: 18px; 
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #4466f2;
    border-color: #4466f2;
    padding: 12px 24px; 
    font-size: 16px; 
    border-radius: 25px; 
}

.btn-primary:hover {
    background-color: #3355cc;
}

.btn-primary:focus {
    box-shadow: 0 0 0 3px rgba(68, 102, 242, 0.5); 
}

</style>
    
<?php include 'include/navbar.php'; ?>

<section id="page-header">
    <h2>#shopathome</h2>
    <p>Save more with coupons & up to 70% off! </p>
</section>

<?php if ($isEmpty): ?>
<section id="empty-cart-message" class="section-p1">
    <div class="empty-cart-content">
    <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
									<h3><strong>Your Cart is Empty</strong></h3>
									<h4>Before proceed to checkout you must add some product to your shopping cart!</h4>
									<a href="shop.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
    </div>
</section>
<?php else: ?>
<section id="cart" class="section-p2">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
            <tr>
              <td>
            <!-- Button to remove the item -->
            <button class="remove-button" onclick="removeCartItem(<?php echo $item['id']; ?>)">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
            </td>
            <td>
                    <img src="shop_product/<?php echo $item['image']; ?>" alt="">
                    <img src="feature_products/<?php echo $item['image']; ?>" alt="">
                    <img src="new_arrival/<?php echo $item['image']; ?>" alt="">
            </td>                
            <td><?php echo $item['product_name']; ?></td>
                <td>Php <?php echo $item['price']; ?></td>
                <td>
                    <!-- Set the maximum value based on the available stock -->
                    <input type="number" value="<?php echo $item['quantity']; ?>" min="0" onchange="updateQuantity(<?php echo $item['id']; ?>, this.value)">
                </td>
                <td id="subtotal_<?php echo $item['id']; ?>">Php <?php echo $item['price'] * $item['quantity']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section id="cart-add" class="section-p1">
    <div id="coupon">
        <h3>Apply Coupon</h3>
        <div>
            <input type="text" placeholder="Enter Your Coupon">
            <button class="normal">Apply</button>
        </div>
    </div>

    <div id="subtotal">
        <h3>Cart Totals</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td id="cart_subtotal">Php <?php echo $subtotal; ?></td>
            </tr>

            <tr>
                <td>Shipping Fee</td>
                <td>Free</td>
            </tr>

            <tr>
                <td><strong>Total</strong></td>
                <td><strong id="total">₱ <?php echo $total; ?></strong></td>
            </tr>
        </table>
       <!-- Proceed to Checkout form -->
    <form action="checkout.php" method="get">
        <!-- Hidden input to pass cart data -->
        <input type="hidden" name="cart_data" value="<?php echo $cartData; ?>">
        <button type="submit">Proceed to Checkout</button>
    </form>
    </div>
</section>
<?php endif; ?>

<?php include 'include/footer.php'; ?>

<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>

document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to the "Proceed to Checkout" button
    document.getElementById("proceedToCheckoutBtn").addEventListener("click", function() {
        // Redirect to the checkout page (checkout.php)
        window.location.href = "checkout.php";
    });
});

// Function to remove an item from the cart
function removeCartItem(productId) {
    //  AJAX request to remove the item from the cart
    $.ajax({
        url: 'remove_cart.php',
        method: 'POST',
        data: { productId: productId },
        success: function(response) {
            // If removal is successful, reload the cart or update its display
            location.reload(); // Reload the page to reflect the changes
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Function to add an item to the cart
function addToCart(productId) {
    var clientId = <?php echo $_SESSION['user_id']; ?>; 

    //  AJAX request to add the item to the cart
    $.ajax({
        url: 'add_to_cart.php',
        method: 'POST',
        data: { productId: productId, clientId: clientId }, 
        success: function(response) {
            // Update cart count
            updateCartCount();
            // Update quantity of added item
            updateCartItemQuantity(productId);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}



// Function to update quantity and subtotal
function updateQuantity(itemId, quantity) {
    $.ajax({
        url: 'update_quantity.php',
        method: 'POST',
        data: { itemId: itemId, quantity: quantity },
        success: function(response) {
            // Update the subtotal for the specific item
            var subtotal = parseFloat(response);
            $("#subtotal_" + itemId).text("Php " + subtotal.toFixed(2));

            // Update cart subtotal and total
            updateCartTotals();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Function to update cart subtotal and total
function updateCartTotals() {
    var cartSubtotal = 0;
    $(".section-p2 tbody tr").each(function() {
        var subtotalText = $(this).find("td:last-child").text();
        var subtotal = parseFloat(subtotalText.replace("Php ", ""));
        cartSubtotal += subtotal;
    });
    $("#cart_subtotal").text("Php " + cartSubtotal.toFixed(2));
    $("#total").text("Php " + cartSubtotal.toFixed(2));
}
</script>

</body>
</html>
