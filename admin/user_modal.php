<style>

.close {
    position: absolute;
    top: 10px;
    right: 10px;
}

</style>

<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form id="editForm" method="post" action="user_edit.php">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="form-group">
                        <label for="editUsername">Username:</label>
                        <input type="text" class="form-control" id="editUsername" name="username">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone:</label>
                        <input type="text" class="form-control" id="editPhone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="editAddress">Address:</label>
                        <textarea class="form-control" id="editAddress" name="address"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add New User Modal -->
<div id="addnew" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="add_user.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add New User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
