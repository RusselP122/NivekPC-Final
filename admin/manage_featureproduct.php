<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_username'])) {
    // Redirect to the 404 access denied page
    header("Location: 403.php");
    exit();
}
?>


<html>

<head>
    <title>Admin - Manage Feature Products</title>
    <link rel="stylesheet" href="manage_product.css">
    <link rel="stylesheet" href="mproduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        body {
            background-color: #1b203d;
        }
    </style>

</head>

<body>

    <?php include_once 'sidenav.php'; ?>


    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav">☰ Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Dashboard</span>
            </div>

            <div class="col-div-6 profile-container">
                <div class="profile">
                    <img src="avatar.png" class="pro-img" />
                    <p>Administrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
                    <div class="profile-div">
                        <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="product-heading">Feature Product List</h2>

        <form action="" class="search-bar">
            <input type="search" name="search" pattern=".*\S.*" required>
            <button class="search-btn" type="submit">
                <span>Search</span>
            </button>
        </form>

        <div class="new-button-container">
            <div class="box-header with-border">
                <a href="#addProductModal" data-toggle="modal" class="btn btn-primary btn-sm btn-flat new-button">
                    <i class="fa fa-plus"></i> Add Feature Product
                </a>
            </div>
        </div>

        <div class="table-container">
            <table>
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th class="sortable">ProductID<span class="fa fa-caret-down"></span><span class="fa fa-caret-up"></span></th>
                        <th class="sortable">Price <span class="fa fa-caret-down"></span><span class="fa fa-caret-up"></span></th>
                        <th class="sortable">Stock <span class="fa fa-caret-down"></span><span class="fa fa-caret-up"></span></th>
                        <th>Description</th>
                        <th>Status <span class="fa fa-caret-down"></span><span class="fa fa-caret-up"></span></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once "../include/conn.php";
                    include_once 'feature_modal.php';

                    // Define how many products to display per page
                    $productsPerPage = 10;

                    // Get the current page number, default to 1 if not set
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the offset for fetching products from the database
                    $offset = ($current_page - 1) * $productsPerPage;

                    // Initialize the search query variable
                    $searchQuery = '';

                    // Check if search query is submitted
                    if (isset($_GET['search'])) {
                        // Sanitize the search query to prevent SQL injection
                        $searchQuery = htmlspecialchars($_GET['search']);
                        // Modify the SQL query to include search functionality
                        $sql = "SELECT * FROM feature_products WHERE product_name LIKE '%$searchQuery%' LIMIT $offset, $productsPerPage";
                    } else {
                        // Default SQL query without search functionality
                        $sql = "SELECT * FROM feature_products LIMIT $offset, $productsPerPage";
                    }

                    // Fetch products from the database with pagination
                    $result = $pdo->query($sql);

                    // Check if there are products in the database
                    if ($result->rowCount() > 0) {
                        // Define the path to the folder where feature product images are stored
                        $featureImageFolder = "../feature_products/";

                        // Iterate through the feature product rows and display them in the table
                        while ($product = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>{$product['product_id']}</td>";
                            echo "<td><img src='{$featureImageFolder}{$product['product_img']}' alt='Product Image' class='product-img'></td>";
                            echo "<td>{$product['product_name']}</td>";
                            echo "<td>{$product['product_id']}</td>";
                            echo "<td>₱ {$product['product_price']}</td>";
                            echo "<td>{$product['stock']}</td>";
                            echo "<td><span>{$product['description']}</span></td>"; // Modified line
                            echo "<td>";
                            echo $product['stock'] > 0 ? "Active" : "Out of Stock";
                            echo "</td>";
                            echo "<td>";
                            echo "<button class='edit-button' data-product-id='{$product['product_id']}'><i class='fa fa-edit'></i> Edit</button>";
                            echo "<button class='delete-button' data-product-id='{$product['product_id']}' onclick=\"confirmProductDelete({$product['product_id']})\"><i class='fa fa-trash'></i> Delete</button>";

                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No feature products found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            <ul class="pagination">
                <?php
                // Calculate total number of feature products
                $total_products_sql = "SELECT COUNT(*) AS total FROM feature_products";
                $total_products_result = $pdo->query($total_products_sql);
                $total_products_row = $total_products_result->fetch(PDO::FETCH_ASSOC);
                $total_products = $total_products_row['total'];

                // Calculate total number of pages
                $total_pages = ceil($total_products / $productsPerPage);

                // Display pagination links
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<li><a href='?page=$i'>$i</a></li>";
                }

                ?>
            </ul>
        </div>

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="mp.js"></script>
    <script src="adminpanel.js"></script>


    <script>
        $(document).ready(function() {

            $('.edit-button').click(function() {
                var productId = $(this).data('product-id');
                $.ajax({
                    url: 'feature_get_product.php',
                    type: 'POST',
                    data: { productId: productId },
                    dataType: 'json',
                    success: function(response) {
                        $('#editProductId').val(response.product_id);
                        $('#editProductName').val(response.product_name);
                        $('#editProductPrice').val(response.product_price);
                        $('#editProductStock').val(response.stock);
                        $('#editProductDescription').val(response.description);
                        $('#editProductModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.delete-button').click(function() {
                var productId = $(this).data('product-id');

                confirmProductDelete(productId);
            });

            // Function to display SweetAlert confirmation for product deletion
            function confirmProductDelete(productId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure you want to remove this record?",
                    icon: 'warning',
                    iconHtml: '<i class="fas fa-trash" style="color: red;"></i>',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //  AJAX request to delete the product
                        $.ajax({
                            type: 'POST',
                            url: 'feature_delete_product.php',
                            data: { product_id: productId },
                            success: function(response) {
                                // Reload the page or update the table if needed
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            }

        });

        $(document).ready(function () {
    // Retrieve sorting state from URL parameters
    var urlParams = new URLSearchParams(window.location.search);
    var column = urlParams.get('sortColumn') || 0; // Default to first column if not set
    var direction = urlParams.get('sortDirection') || 'asc'; // Default to ascending order if not set

    // Apply initial sorting
    sortTable(column, direction);

    // Function to toggle caret direction on sortable table headers and sort data
    $('th.sortable').click(function () {
        var columnIndex = $(this).index(); // Get the index of the clicked column

        // Toggle caret-up and caret-down classes on the clicked table header
        $(this).find('span.fa-caret-up, span.fa-caret-down').toggleClass('fa-caret-up fa-caret-down');

        // Determine the sorting direction for the clicked column
        if (column == columnIndex) {
            // Reverse the direction if clicking on the same column
            direction = direction === 'asc' ? 'desc' : 'asc';
        } else {
            // Set direction to ascending if clicking on a different column
            direction = 'asc';
            column = columnIndex;
        }

        // Call a function to sort the table data
        sortTable(column, direction);

        // Update URL parameters with sorting state
        var queryParams = new URLSearchParams(window.location.search);
        queryParams.set('sortColumn', column);
        queryParams.set('sortDirection', direction);
        window.history.replaceState({}, '', window.location.pathname + '?' + queryParams.toString());
    });

// Function to sort the table data based on the column and direction
function sortTable(column, direction) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = $('table')[0]; // Get the table element
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName('td')[column];
            y = rows[i + 1].getElementsByTagName('td')[column];
            if (column === 3 || column === 4 || column === 5) { // Check if sorting ProductID, Price, or Stock column
                // Extract the numeric value from the inner HTML of the cells
                var xValue = extractNumericValue(x.innerHTML);
                var yValue = extractNumericValue(y.innerHTML);
                // Convert the extracted values to numbers for comparison
                x = parseFloat(xValue);
                y = parseFloat(yValue);
            } else {
                x = x.innerHTML;
                y = y.innerHTML;
            }
            if (direction === 'asc') {
                shouldSwitch = compareValues(x, y);
            } else if (direction === 'desc') {
                shouldSwitch = compareValues(y, x);
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
}

// Function to extract numeric value from a string with currency symbol and potential commas
function extractNumericValue(str) {
    // Remove the currency symbol and commas, then parse the string as a float
    return parseFloat(str.replace('₱', '').replace(/,/g, ''));
}

    // Function to compare values based on their types
    function compareValues(value1, value2) {
        if (!isNaN(value1) && !isNaN(value2)) {
            return parseFloat(value1) > parseFloat(value2);
        } else if (value1.toLowerCase() < value2.toLowerCase()) {
            return true;
        }
        return false;
    }
});


    </script>
</body>

</html>
