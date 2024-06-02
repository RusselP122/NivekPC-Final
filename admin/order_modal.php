<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editOrderForm">
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="editUsername">
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="editAddress">
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="editPhone">
                    </div>
                    <div class="mb-3">
                        <label for="editDateOrdered" class="form-label">Date Ordered</label>
                        <input type="text" class="form-control" id="editDateOrdered" name="editDateOrdered">
                    </div>
                    <div class="mb-3">
                        <label for="editPaymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" id="editPaymentStatus" name="editPaymentStatus">
                            <option value="Paid">Paid</option>
                            <option value="Awaiting Authentication">Awaiting Authentication</option>
                            <option value="Payment Failed">Payment Failed</option>
                            <option value="Unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editTotal" class="form-label">Total</label>
                        <input type="text" class="form-control" id="editTotal" name="editTotal">
                    </div>
                    <div class="mb-3">
                        <label for="editPaymentMethod" class="form-label">Payment Method</label>
                        <select class="form-select" id="editPaymentMethod" name="editPaymentMethod">
                            <option value="COD">COD</option>
                            <option value="GCASH">GCASH</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editOrderStatus" class="form-label">Order Status</label>
                        <select class="form-select" id="editOrderStatus" name="editOrderStatus">
                            <option value="Processing">Processing</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>

                    <input type="hidden" id="editOrderId" name="editOrderId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editOrderBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

  <!--  Order Modal -->
  <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderModalLabel">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form method="POST" action="add_order.php">
                        <div class="mb-3 cursor-pointer"> 
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control cursor-pointer" id="username" name="username" required>
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control cursor-pointer" id="address" name="address" required>
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control cursor-pointer" id="phone" name="phone">
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="dateOrdered" class="form-label">Date Ordered</label>
                            <input type="text" class="form-control datepicker cursor-pointer" id="dateOrdered" name="dateOrdered" autocomplete="off">
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="paymentStatus" class="form-label">Payment Status</label>
                            <select class="form-select cursor-pointer" id="paymentStatus" name="paymentStatus">
                                <option value="Paid">Paid</option>
                                <option value="Awaiting Authentication">Awaiting Authentication</option>
                                <option value="Payment Failed">Payment Failed</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control cursor-pointer" id="total" name="total">
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="paymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select cursor-pointer" id="paymentMethod" name="paymentMethod">
                                <option value="COD">COD</option>
                                <option value="GCASH">GCASH</option>
                            </select>
                        </div>
                        <div class="mb-3 cursor-pointer"> 
                            <label for="orderStatus" class="form-label">Order Status</label>
                            <select class="form-select cursor-pointer" id="orderStatus" name="orderStatus">
                                <option value="Processing">Processing</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addOrder">Add Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>