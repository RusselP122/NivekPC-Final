
<?php include_once "include/conn.php"; ?>


<footer class="section-p2">
    <div class="col">
        <img class="logo" src="logo.png" alt="" width="200px">
        <h4>Contact</h4>
        <?php
        // Contact details from the database
        try {
            $stmt = $pdo->query("SELECT contacts FROM system_info WHERE id = 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if contacts data is available and properly formatted as JSON
            if (!empty($row['contacts'])) {
                $contacts = json_decode($row['contacts'], true);

                // Check if $contacts is an array before displaying contact details
                if (is_array($contacts)) {
                    // Display contact details
                    foreach ($contacts as $key => $value) {
                        echo "<p><i class='fa-regular fa-$key'></i> $value</p>";
                    }
                } else {
                    // Handle case where $contacts is not an array
                    echo "Error: Invalid contact information format.";
                }
            } else {
                // Handle case where no contact information is available
                echo "No contact information available.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
            
            <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>
    </div>

        <div class="col">
            <h4>About</h4>
                <a href="about.php">About us</a>
                <a href="delivery.php">Delivery Information</a>
                <a href="privacy.php">Privacy Policy</a>
                <a href="term.php">Terms & Conditions</a>
                <a href="contact.php">Contact Us</a> 
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="mypurchase.php"> Order Status</a>
        </div>

        <div class="col install">
            <h4>Payments</h4>
            <p>Secured Payment Gateways </p>
            <img src="images/gcash.png" alt="">
        </div>

        <div class="copyright">
            <p class="copyright-text">© 2024, Nivek PC Repairs</p>
        </div>
    </footer>

<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 17946699;
    window.__lc.integration_name = "manual_onboarding";
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/17946699/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->
