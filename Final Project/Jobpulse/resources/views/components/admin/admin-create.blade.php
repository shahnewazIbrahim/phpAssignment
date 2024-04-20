<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Create Admin</h6>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="firstName">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lastName">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Email *</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Mobile Name *</label>
                                <input type="text" class="form-control" id="mobile">
                            </div>

                            <div class="col-12 p-1">
                                <label class="form-label">Password *</label>
                                <input type="text" class="form-control" id="password">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Role *</label>
                                <select type="text" class="form-control" id="role">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="userSave()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>
