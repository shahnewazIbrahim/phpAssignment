<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="adminFirstNameUpdate">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="adminLastNameUpdate">
                                <label class="form-label">Email *</label>
                                <input type="text" class="form-control" id="adminEmailUpdate">
                                <label class="form-label">Mobile *</label>
                                <input type="text" class="form-control" id="adminMobileUpdate">
                                <label class="form-label">Role *</label>
                                <select type="text" class="form-control" id="adminRoleUpdate">
                                    <option value="">select</option>
                                </select>
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="userUpdate()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>
