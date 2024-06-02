<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the username and password 
    if ($username === "admin" && $password === "admin123") {
        // Username and password are correct, set the session and redirect to admin dashboard
        $_SESSION['admin_username'] = $username;
        header("Location: admindashboard.php");
        exit();
    } else {
        // Invalid username or password, show error message
        $errorMessage = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NivekPc - Admin Login</title>
    <link rel="stylesheet" href="adminlog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <span class="span1">- NivekPC <span>Team -</span></span>
            <br/>
            <span class="span2">admin panel</span>
            <hr/>
        </div>
      
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input id="usernameInput" class="user" type="text" name="username" maxlength="28" placeholder="Username" required>
            <div class="password-container">
                <input id="passwordInput" class="pass" type="password" name="password" maxlength="16" placeholder="Password" required>
                <i class="fas fa-eye-slash toggle-password"></i>
            </div>
            <div class="remdiv">
                <input class="remcheck" type="checkbox" name="remember">
                <span class="remspan">Remember me</span>
            </div>
            <input class="submit" type="submit" value="Login">
            <span id="errorMessage" class="error-message" style="<?php echo isset($errorMessage) ? 'display: block;' : 'display: none;'; ?>"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span>
        </form>
      
        <div class="bydiv">
            <span>All rights reserved 2024 &copy; NivekPc</span>
        </div>
    </div>
    <script src="/admin/adminlogin.js"></script>
   
</body>
</html>
