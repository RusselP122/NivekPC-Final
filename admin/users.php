<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_username'])) {
    // Redirect to the 404 access denied page
    header("Location: 403.php");
    exit();
}

?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="manage_product.css">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>

             /* Table Styles */
             table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
       
       body {
  background-color: #1b203d;
}

.edit-button {
  background-color: #28a745; 
  border: none;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}

.edit-button:hover {
  background-color: #218838;
}

.delete-button {
  background-color: #dc3545; 
  color: white;
  border: none;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 4px;
}

.delete-button:hover {
  background-color: #c82333; 
}

.new-button-container {
  margin-top: 20px; 
  
}


.admin-section {
        margin-bottom: 20px; 
    }

.search-bar-container {
        position: relative;
        margin-top: 5px; 
        top: 0;
        left: 0;
        width: 100%;
        padding: 10px 20px;
        box-sizing: border-box;
    }


    .search-bar input[type="search"] {
        width: 200px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
    }

    .search-bar .search-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 14px;
        margin-left: 5px;
    }

    .search-bar .search-btn:hover {
        background-color: #45a049;
    }

.search-bar .search-btn:hover {
  background-color: #45a049;
}

.table-pagination-container {
    position: relative;
}


.pagination {
    position: relative;
    margin-top: 20px; 
    display: flex;
    justify-content: flex-end;
}

.pagination a {
    color: black;
    display: inline-block; 
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}

@media only screen and (max-width: 768px) {
  .search-bar {
    width: 100%;
  }
}

    </style>
    <?php include_once 'sidenav.php'; ?>
</head>
<body>

<div id="main">
    <div class="head">
        <div class="col-div-6">
            <span style="font-size:30px;cursor:pointer; color: white;" class="nav"  >☰ Dashboard</span>
            <span style="font-size:30px;cursor:pointer; color: white;" class="nav2"  >☰ Dashboard</span>
        </div>

        <div class="col-div-6 profile-container">
            <div class="profile">
                <img src="avatar.png" class="pro-img" />
                <p>Adminstrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
                <div class="profile-div">
                <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
                </div>
            </div>
        </div>
    </div>
    
   

    <h2 class="product-heading">User List</h2> 
    
    <div class="search-bar-container">
        <form action="" class="search-bar">
            <input type="search" name="search" placeholder="Search by username" pattern=".*\S.*" required>
            <button class="search-btn" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>

                <!-- New button container -->
                <div class="new-button-container">
        <div class="box-header with-border">
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat new-button"><i class="fa fa-plus"></i> Add Users</a>
        </div>

    </div>
    
    
    <div class="table-container">
        <table>
            
            <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                
            <?php

include_once "../include/conn.php";
            include_once 'user_modal.php'; 

            // Initialize variables for pagination
            $records_per_page = 10;
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $records_per_page;

            // Initialize the search term variable
            $searchTerm = '';

          
            if(isset($_GET['search'])){
                $searchTerm = $_GET['search'];
            }

            // Query to count total records
            $total_stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM users WHERE username LIKE :searchTerm AND username != 'admin'");
            $total_stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
            $total_records = $total_stmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Calculate total pages
            $total_pages = ceil($total_records / $records_per_page);

            // Query to fetch user data based on the search term and pagination
            if(!empty($searchTerm)) {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username LIKE :searchTerm AND username != 'admin' LIMIT :offset, :records_per_page");
                $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                // If search term is empty, fetch all users with pagination
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username != 'admin' LIMIT :offset, :records_per_page");
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
                $stmt->execute();
            }

            // Check if there are any results
            if($stmt->rowCount() > 0) {
                $counter = $offset + 1;
                // Loop through each row in the result set
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>";
                    echo "<button class='edit-button' data-toggle='modal' data-target='#editModal' data-id='".$row['user_id']."'><i class='fa fa-edit'></i> Edit</button>";
                    echo "<button class='delete-button' data-toggle='modal' data-target='#deleteModal' data-id='".$row['user_id']."'><i class='fa fa-trash'></i> Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // Display a message if no matching users found
                echo "<tr><td colspan='7'>No users found</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>

     <!-- Pagination links -->
 <div class="pagination">
        <?php if($page > 1): ?>
            <a href="?page=<?php echo ($page-1); ?>&search=<?php echo $searchTerm; ?>">Previous</a>
        <?php endif; ?>
        <?php for($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo $searchTerm; ?>" <?php echo ($page == $i) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if($page < $total_pages): ?>
            <a href="?page=<?php echo ($page+1); ?>&search=<?php echo $searchTerm; ?>">Next</a>
        <?php endif; ?>
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="mp.js"></script>
<script src="adminpanel.js"></script>


<script>
$(document).ready(function() {
    $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        // Fetch the user data from the server and fill the form fields
        $.ajax({
            url: 'get_user.php',
            type: 'POST',
            data: { userId: id },
            dataType: 'json',
            success: function(response) {
                $('#editUserId').val(response.user_id);
                $('#editUsername').val(response.username);
                $('#editEmail').val(response.email);
                $('#editPhone').val(response.phone);
                $('#editAddress').val(response.address);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('.delete-button').on('click', function() {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "Are you sure you want to remove this record?",
        iconHtml: '<i class="fas fa-trash" style="color: red;"></i>',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: { userId: id },
                success: function(response) {
                    // Refresh the page or remove the deleted user from the table
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});

});
</script>

</body>
</html>