<!-- Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" action="feature_add_product.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="productStock">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="productStock" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image</label>
                        <input type="file" class="form-control-file" id="productImage" name="productImage" accept="image/*" required>
                        <img id="imagePreview" src="#" alt="Product Image Preview" style="display: none; max-width: 100%; margin-top: 10px;">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <div id="formFeedback" class="mt-2"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="feature_edit_product.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="editProductId" name="productId">
                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductPrice">Price</label>
                        <input type="number" class="form-control" id="editProductPrice" name="productPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductStock">Stock</label>
                        <input type="number" class="form-control" id="editProductStock" name="productStock" required>
                    </div>
                    <div class="form-group">
                        <label for="editProductDescription">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="productDescription" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editProductImage">New Product Image</label>
                        <input type="file" class="form-control-file" id="editProductImage" name="productImage" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview
    document.getElementById('productImage').onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    };

      // Image preview for edit product modal
    document.getElementById('editProductImage').onchange = function(event) {
        console.log("File input changed"); // Add this line to check if the event is triggered
        var reader = new FileReader();
        reader.onload = function() {
            console.log("File read"); // Add this line to check if the file is read
            var output = document.getElementById('editImagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    };

</script>


