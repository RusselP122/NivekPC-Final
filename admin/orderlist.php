<?php
include_once "../include/conn.php";
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_username'])) {
    // Redirect to the 404 access denied page
    header("Location: 403.php");
    exit();
}

//  order data from the database with date ordered as date only
$stmt = $pdo->query("SELECT *, DATE(date_ordered) AS ordered_date FROM order_list");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Order List</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="ordersss.css">
    <link rel="stylesheet" href="manage_product.css">
    <?php include_once 'sidenav.php'; ?>
    <?php include_once 'order_modal.php'; ?>
</head>

<body class="snippet-body">
    <div id="main" class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="head d-flex justify-content-between align-items-center">
                    <span class="nav" style="font-size:30px; cursor:pointer; color: white;">☰ Dashboard</span>
                    <span style="font-size:30px;cursor:pointer; color: white;" class="nav2">☰ Dashboard</span>

                    <div class="profile">
                        <img src="avatar.png" class="pro-img" />
                        <p>Administrator <i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
                        <div class="profile-div">
                            <p><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></p>
                        </div>
                    </div>
                </div>

                <h1 class="order-list-heading">Order List</h1>

                <div class="container mt-5">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" style="width: 100%;" placeholder="Search">
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addOrderModal">Add Order <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-borderless main">
                                    <thead>
                                        <tr class="head">
                                            <th scope="col">Username</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Date Ordered</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($orders as $order) {
                                            $paymentStatusClass = '';
                                            switch ($order['payment_status']) {
                                                case 'Paid':
                                                    $paymentStatusClass = 'payment-status-paid';
                                                    break;
                                                case 'Awaiting Authentication':
                                                    $paymentStatusClass = 'payment-status-awaiting';
                                                    break;
                                                case 'Payment Failed':
                                                    $paymentStatusClass = 'payment-status-failed';
                                                    break;
                                                case 'Unpaid':
                                                    $paymentStatusClass = 'payment-status-unpaid';
                                                    break;
                                                default:
                                                    $paymentStatusClass = '';
                                                    break;
                                            }

                                            $orderStatusClass = '';
                                            switch ($order['order_status']) {
                                                case 'Processing':
                                                    $orderStatusClass = 'order-status-processing';
                                                    break;
                                                case 'Delivered':
                                                    $orderStatusClass = 'order-status-delivered';
                                                    break;
                                                case 'Cancelled':
                                                    $orderStatusClass = 'order-status-cancelled';
                                                    break;
                                                default:
                                                    $orderStatusClass = '';
                                                    break;
                                            }

                                            echo "<tr class='rounded bg-white'>";
                                            echo "<td>{$order['username']}</td>";
                                            echo "<td>{$order['id']}</td>";
                                            echo "<td>{$order['address']}</td>";
                                            echo "<td>{$order['phone']}</td>";
                                            echo "<td>{$order['ordered_date']}</td>";
                                            echo "<td class='$paymentStatusClass'>{$order['payment_status']}</td>"; 
                                            echo "<td>₱{$order['total']}</td>";
                                            echo "<td>{$order['payment_method']}</td>";
                                            echo "<td class='$orderStatusClass'>{$order['order_status']}</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-sm btn-edit' data-bs-toggle='modal' data-bs-target='#editOrderModal' onclick='openEditModal({$order['id']}, \"{$order['username']}\", \"{$order['address']}\", \"{$order['phone']}\", \"{$order['ordered_date']}\", \"{$order['payment_status']}\", \"{$order['total']}\", \"{$order['payment_method']}\", \"{$order['order_status']}\")'><i class='fas fa-edit'></i> Edit</button>";
                                            echo "<button class='btn btn-sm btn-delete' onclick='confirmDelete({$order['id']})'><i class='fas fa-trash'></i> Delete</button>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end" id="pagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="adminpanel.js"></script>


    <script>
function openEditModal(orderId, username, address, phone, dateOrdered, paymentStatus, total, paymentMethod, orderStatus) {
    $('#editUsername').val(username);
    $('#editAddress').val(address);
    $('#editPhone').val(phone);
    $('#editDateOrdered').val(dateOrdered);
    $('#editPaymentStatus').val(paymentStatus);
    $('#editTotal').val(total);
    $('#editPaymentMethod').val(paymentMethod);
    $('#editOrderStatus').val(orderStatus);
    $('#editOrderModal').modal('show');

    $('#editOrderBtn').off('click').on('click', function() {
        var newUsername = $('#editUsername').val();
        var newAddress = $('#editAddress').val();
        var newPhone = $('#editPhone').val();
        var newDateOrdered = $('#editDateOrdered').val();
        var newPaymentStatus = $('#editPaymentStatus').val();
        var newTotal = $('#editTotal').val();
        var newPaymentMethod = $('#editPaymentMethod').val();
        var newOrderStatus = $('#editOrderStatus').val();

        $.ajax({
            type: 'POST',
            url: 'update_order_status.php',
            data: {
                orderId: orderId,
                newUsername: newUsername,
                newAddress: newAddress,
                newPhone: newPhone,
                newDateOrdered: newDateOrdered,
                newPaymentStatus: newPaymentStatus,
                newTotal: newTotal,
                newPaymentMethod: newPaymentMethod,
                newOrderStatus: newOrderStatus
            },
            success: function(response) {
                console.log(response);
                
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
}


        $(document).ready(function() {
         
            $('#editDateOrdered').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        $(document).ready(function() {
           
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        function confirmDelete(orderId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
    iconHtml: '<i class="fas fa-trash" style="color: red;"></i>',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            //  AJAX request to delete the order
            $.ajax({
                type: 'POST',
                url: 'delete_order.php',
                data: { orderId: orderId },
                success: function(response) {
                    console.log(response);
                 
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
}

        var ordersPerPage = 10; // Number of orders per page
        var orders = <?php echo json_encode($orders); ?>; 

        function generatePagination(totalPages, currentPage) {
            var paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = ''; // Clear previous pagination links

            // Create "Previous" link
            var previousLink = document.createElement('li');
            previousLink.className = 'page-item';
            if (currentPage > 1) {
                previousLink.innerHTML = '<a class="page-link" href="#" onclick="changePage(' + (currentPage - 1) + ')">Previous</a>';
            } else {
                previousLink.innerHTML = '<span class="page-link disabled">Previous</span>';
            }
            paginationContainer.appendChild(previousLink);

            // Create numbered page links
            for (var i = 1; i <= totalPages; i++) {
                var pageLink = document.createElement('li');
                pageLink.className = 'page-item';
                if (i === currentPage) {
                    pageLink.innerHTML = '<span class="page-link">' + i + '</span>';
                    pageLink.classList.add('active');
                } else {
                    pageLink.innerHTML = '<a class="page-link" href="#" onclick="changePage(' + i + ')">' + i + '</a>';
                }
                paginationContainer.appendChild(pageLink);
            }

            // Create "Next" link
            var nextLink = document.createElement('li');
            nextLink.className = 'page-item';
            if (currentPage < totalPages) {
                nextLink.innerHTML = '<a class="page-link" href="#" onclick="changePage(' + (currentPage + 1) + ')">Next</a>';
            } else {
                nextLink.innerHTML = '<span class="page-link disabled">Next</span>';
            }
            paginationContainer.appendChild(nextLink);
        }

        function changePage(pageNumber) {
            // Calculate start and end index of orders for the selected page
            var startIndex = (pageNumber - 1) * ordersPerPage;
            var endIndex = startIndex + ordersPerPage;

            // Slice the orders array to get orders for the selected page
            var ordersForPage = orders.slice(startIndex, endIndex);

            console.log('Loading page ' + pageNumber);
            console.log('Orders for page ' + pageNumber + ':', ordersForPage);

        }

        var totalPages = Math.ceil(orders.length / ordersPerPage);

        generatePagination(totalPages, 1);

    </script>

</body>

</html>