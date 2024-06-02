<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Nivek PC</title>
    <?php include_once "include/conn.php"; ?>
    <?php include 'include/navbar.php'; ?>
</head>
<body>


     <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
            <?php
//  contact details from the database
try {
    $stmt = $pdo->query("SELECT contacts FROM system_info WHERE id = 1");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if contacts data is available and properly formatted as JSON
    if (!empty($row['contacts'])) {
        $contacts = json_decode($row['contacts'], true);

        // Check if $contacts is an array before looping through it
        if (is_array($contacts)) {
            // Display contact details
            foreach ($contacts as $key => $value) {
                echo "<li><i class='fa-regular fa-$key'></i><p>$value</p></li>";
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

            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.009830168008!2d121.30271007486333!3d14.13551948629754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd5d3eb5847f9f%3A0xd3f0c85622b0d844!2sNaning%20Clan%20Surveilance%20Services!5e0!3m2!1sen!2sph!4v1712203060406!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>

      </section>




    <?php include 'include/footer.php'; ?>


    <script src="script.js"></SCript>
</body>
</html>