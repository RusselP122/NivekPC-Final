<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antivirus Service</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <?php include 'include/navbar.php'; ?>
</head>
<body>


    <header>
        <h1 class="title">AntiVirus</span></h1>
    </header>
    <main>
        <div class="tabs">
            <div class="tab active" onclick="toggleTab('tab1')">Features</div>
            <div class="tab" onclick="toggleTab('tab2')">Compatibility</div>
            <div class="tab" onclick="toggleTab('tab3')">Pricing</div>
        </div>
        <div id="tab1" class="tab-content active">
            <h2>Features</h2>
            <ul>
                <li>Scan your devices for viruses and malware</li>
                <li>Block suspicious websites and downloads</li>
                <li>Schedule regular automatic scans</li>
                <li>Get real-time protection against new threats</li>
            </ul>
        </div>
        <div id="tab2" class="tab-content">
            <h2>Compatibility</h2>
            <p>Our software is compatible with Windows, Mac, and mobile devices.</p>
        </div>
        <div id="tab3" class="tab-content">
            <h2>Pricing</h2>
            <p>Contact us for pricing details.</p>
        </div>
        <div class="accordion">
            <div class="accordion-header" onclick="toggleAccordion('accordion1')">FAQs</div>
            <div id="accordion1" class="accordion-content">
                <h2>FAQs</h2>
                <h3>Q: Is there a free trial available?</h3>
                <p>A: Yes, we offer a free trial for our antivirus software.</p>
                <h3>Q: How can I contact support?</h3>
                <p>A: You can contact our support team through email or phone.</p>
            </div>
        </div>
    </main>
   
    <?php include 'include/footer.php'; ?>


    <script src="script.js"></SCript>
    <script>
        function toggleTab(tabId) {

            document.querySelectorAll('.tab-content').forEach(function (tabContent) {
                tabContent.classList.remove('active');
            });

            
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.classList.remove('active');
            });

            
            document.getElementById(tabId).classList.add('active');

            
            document.querySelector('[onclick="toggleTab(\'' + tabId + '\')"]').classList.add('active');
        }

        function toggleAccordion(accordionId) {
            var accordionContent = document.getElementById(accordionId);
            accordionContent.classList.toggle('active');
        }
    </script>
</body>
</html>
