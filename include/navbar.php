<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}   

include_once "include/conn.php";

// Initialize a variable to store the updated user ID
$updated_user_id = "";

// Retrieve the updated value from the cookie
if (isset($_COOKIE["user_id"])) {
    $updated_user_id = $_COOKIE["user_id"];
} else {
    // Handle case when the user ID cookie is not set
    $updated_user_id = null; // Assign null or handle it according to your requirement
}




?>

<style>
  
#navbar li.active a {
    color: hsl(93, 54%, 54%);
    font-weight: bold; 
}

#navbar li.active a::after,
#navbar li a:hover::after {
    content: "";
    width: 30%;
    height: 2px;
    background: #088178;
    position: absolute;
    bottom: -4px;
    left: 20px; 
}


#navbar li#manage-account {
    margin-right: 20px; 
}

#navbar li#manage-account a,
#navbar li a[href="logout.php"] {
    text-decoration: none;
    color: #000000; 
    position: relative;
}

#navbar li#manage-account a:hover,
#navbar li a[href="logout.php"]:hover {
    color: #088178; 
}

#navbar li#manage-account a::after,
#navbar li a[href="logout.php"]::after {
    content: "";
    width: 30%;
    height: 2px;
    background: #088178; 
    position: absolute;
    bottom: -4px;
    left: 20px; 
}

#navbar li a[href="logout.php"] {
    color: #ffffff; 
}


.dropbtn {
  border: none;
  outline: none;
  color: white;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown {
  position: relative;
  display: inline-block;
}


.dropdown-content {
  display: none;
  position: absolute;
  background-color: #331926;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}


.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Cart Icon Container */
#lg-bag {
    position: relative;
    display: inline-block;

}

/* Cart Icon */
#lg-bag a {
    display: inline-block; 
    width: 30px;
    height: 30px;
    background-color: #555;
    border-radius: 50%;
    text-align: center;
    line-height: 30px;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    text-decoration: none; 
}

/* Cart Notification */
#cart-notification {
    top: -5px;
    right: -30px; 
    background-color: red;
    color: #fff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    line-height: 20px;
    text-align: center;
    transform: translate(-150%, -50%);
    overflow: hidden;
    display: <?php echo isset($_SESSION['email']) ? 'block' : 'none'; ?>; /* Hide when not logged in */

}

#cart-notification-mobile {
    top: -5px;
    right: -15px; /* Adjust as needed */
    background-color: red;
    color: #fff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    line-height: 20px;
    text-align: center;
    transform: translate(-150%, -50%);
    overflow: hidden;
    display: <?php echo isset($_SESSION['email']) ? 'block' : 'none'; ?>; /* Hide when not logged in */
}


/* CSS for hiding the cart notification on mobile */
@media only screen and (max-width: 767px) {
    #cart-notification {
        display: none;
    }
}

@media only screen and (max-width: 480px) {
    #cart-notification {
        display: none;
    }
}

</style>
    
<section id="header">
<?php

try {
    // Fetch the logo path from the database
    $stmt = $pdo->query("SELECT logo FROM system_info WHERE id = 1"); 
    $logo_path = $stmt->fetchColumn();
    // Display the logo
    echo '<a href="index.php"><img src="' . $logo_path . '" class="logo" alt="" width="200px"></a>';
} catch (PDOException $e) {
    // Handle any errors that occur during database operations
    echo "Error: " . $e->getMessage();
}
?> 

<div>
    <ul id="navbar">
    <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') echo 'class="active"'; ?>><a href="index.php">Home</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == 'shop.php') echo 'class="active"'; ?>><a href="shop.php">Shop</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == 'Service.php') echo 'class="active"'; ?>><a href="Service.php">Service</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="active"'; ?>><a href="about.php">About</a></li>
    <li <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'class="active"'; ?>><a href="contact.php">Contact</a></li>
    
    
    

    <?php

if(isset($_SESSION['email'])) {
    // Display different links for logged-in users
    echo '<li class="dropdown">';
    echo '<a href="javascript:void(0)" class="dropbtn" onclick="toggleDropdown(\'dropdown-content\')">Account</a>';
    echo '<div id="dropdown-content" class="dropdown-content">';
    echo '<a href="manage_account.php">Manage Account</a>';
    echo '<a href="mypurchase.php">My Purchase</a>';
    echo '<a href="logout.php" onclick="return confirm(\'Are you sure you want to log out?\')">Logout</a>';
    echo '</div>';
    echo '</li>';
} else {
    // Display different link for non-logged-in users
    $activeClass = (basename($_SERVER['PHP_SELF']) == 'account.php') ? 'class="active"' : '';
    echo '<li ' . $activeClass . '><a href="account.php">Account</a></li>';
}
?>

<?php

if (isset($_SESSION['email'])) {
    // User is logged in, display cart icon and notification
    $cartActiveClass = (basename($_SERVER['PHP_SELF']) == 'cart.php') ? 'class="active"' : '';
    echo '<li id="lg-bag" ' . $cartActiveClass . '><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>';
    // Script to fetch and display initial cart count
    echo '<div id="cart-notification"></div>';
    echo '<script>';
    echo 'window.addEventListener("DOMContentLoaded", function() {';
    echo '    $.ajax({';
    echo '        url: "get_cart_count.php",';
    echo '        method: "GET",';
    echo '        success: function(response) {';
    echo '            $("#cart-notification").text(response + " ");';
    echo '        },';
    echo '        error: function(xhr, status, error) {';
    echo '            console.error(xhr.responseText);';
    echo '        }';
    echo '    });';
    echo '});';
    echo '</script>';
}
?>


<a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
</ul>
</div>

<div id="mobile">
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['email'])) {
        // User is logged in, display cart icon and notification in mobile view
        echo '<a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>';
        // Display cart notification here
        echo '<div id="cart-notification-mobile"></div>';
        // Fetch and display initial cart count in mobile view
        echo '<script>';
        echo 'window.addEventListener("DOMContentLoaded", function() {';
        echo '    $.ajax({';
        echo '        url: "get_cart_count.php",';
        echo '        method: "GET",';
        echo '        success: function(response) {';
        echo '            $("#cart-notification-mobile").text(response + " ");';
        echo '        },';
        echo '        error: function(xhr, status, error) {';
        echo '            console.error(xhr.responseText);';
        echo '        }';
        echo '    });';
        echo '});';
        echo '</script>';
    }
    ?>
    <i id="bar" class="fa fa-outdent"></i>
</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function toggleDropdown(id) {
    $("#" + id).toggle();
}

$(document).ready(function(){
    $("#bar").click(function(){
        $("#cart-notification-mobile").hide(); // Hide cart notification when mobile menu icon is clicked
    });

    $("#close").click(function(){
        $("#cart-notification-mobile").show(); // Show cart notification when close icon is clicked
    });
});
</script>


