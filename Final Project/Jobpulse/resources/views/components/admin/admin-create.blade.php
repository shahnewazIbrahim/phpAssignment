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
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>
    async function getRoles(){
       try {
           showLoader();
           let res=await axios.get("/api/list-role",HeaderToken());
           hideLoader();
        //    return console.log({res});

        //    document.getElementById('adminFirstNameUpdate').value=res.data['rows']['firstName'];
        //    document.getElementById('adminLastNameUpdate').value=res.data['rows']['lastName'];
        //    document.getElementById('adminEmailUpdate').value=res.data['rows']['email'];
        //    document.getElementById('adminMobileUpdate').value=res.data['rows']['mobile'];

           const roles = res.data['rows']
            if (roles) {
                let options = `<option value="">Select</option>`
                for (const roleId in roles) {
                    console.log(roles[roleId]);
                    options += `<option value="${roles[roleId]['id']}">${roles[roleId]['name']}</option>`
                }
                document.getElementById('role').innerHTML=options;
            }
       }catch (e) {
           unauthorized(e.response.status)
       }
    }
    getRoles()
    async function Save() {
        try {
            let data = {
               firstName : document.getElementById('firstName').value,
               lastName : document.getElementById('lastName').value,
               email : document.getElementById('email').value,
               mobile : document.getElementById('mobile').value,
               password : document.getElementById('mobile').value,
               roleId: document.getElementById('role').value,

            }
            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post("/api/create-admin",data,HeaderToken())
            hideLoader();

            if(res.data['status']==="success"){
                successToast(res.data['message']);
                document.getElementById("save-form").reset();
                await getList();
            }
            else{
                errorToast(res.data['message'])
            }

        }catch (e) {
            unauthorized(e.response.status)
        }
    }
</script>
