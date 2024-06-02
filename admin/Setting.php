<?php
include_once "../include/conn.php";

// Initialize $about_us_content and $contacts variables
$about_us_content = "";
$contacts = "";

// Check if the database connection is established
if (!$pdo) {
    echo "Database connection failed.";
    exit(); // Terminate further execution if database connection fails
}

// Fetch "About Us" content from the database
try {
    $stmt = $pdo->query("SELECT about_us FROM system_info WHERE id = 1");
    $about_us_content = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Fetch contact details from the database
try {
    $stmt = $pdo->query("SELECT contacts FROM system_info WHERE id = 1");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Assign fetched values to the $contacts variable
    $contacts = $row['contacts'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php include_once 'sidenav.php'; ?>
    <link rel="stylesheet" href="manage_product.css">

    <style>
         img#cimg, img#cimg2 {
            height: auto;
            width: 100%;
            object-fit: cover;
        }

        .container {
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        @media (min-width: 992px) {
            .container {
                margin-left: 100px; /* Move container to the left on larger screens */
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .custom-file-input {
            cursor: pointer;
        }

        .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div id="main" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="head d-flex justify-content-between align-items-center">
                <span style="font-size:30px; cursor:pointer; color: white;" class="nav">☰ Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Dashboard</span>

                <div class="profile">
                    <img src="avatar.png" class="pro-img" />
                    <p>Administrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
                    <div class="profile-div">
                        <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">System Information</h1>
        <form action="update_system_info.php" method="POST" enctype="multipart/form-data">
            <div id="msg" class="form-group"></div>
            <div class="form-group">
                <label for="about_us_editor" class="control-label">About Us</label>
                <textarea id="about_us_editor" name="about_us" cols="30" rows="10" class="form-control"><?php echo htmlspecialchars($about_us_content); ?></textarea>
            </div>
            <div class="form-group">
                <label for="customFile" class="control-label">System Logo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="logo" onchange="displayImg(this,$(this))">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="form-group d-flex justify-content-center">
                <img src="placeholder_logo.png" alt="" id="cimg" class="img-fluid img-thumbnail">
            </div>
            <div class="form-group">
                <label for="contacts_editor" class="control-label">Contact</label>
                <textarea id="contacts_editor" name="contacts" cols="30" rows="10" class="form-control"><?php echo htmlspecialchars($contacts); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.25.1/trumbowyg.min.js"></script>
<script src="adminpanel.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    function displayImg(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
                _this.siblings('.custom-file-label').html(input.files[0].name)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function displayImg2(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _this.siblings('.custom-file-label').html(input.files[0].name)
                $('#cimg2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('#about_us_editor').trumbowyg();
        $('#contacts_editor').trumbowyg(); 
    });
</script>

</body>
</html>
