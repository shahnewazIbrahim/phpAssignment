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
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>


   async function FillUpUpdateForm(id){
       try {
           document.getElementById('updateID').value=id;
           showLoader();
           let res=await axios.post("/api/admin-by-id",{id:id},HeaderToken())
           hideLoader();

           document.getElementById('adminFirstNameUpdate').value=res.data['rows']['firstName'];
           document.getElementById('adminLastNameUpdate').value=res.data['rows']['lastName'];
           document.getElementById('adminEmailUpdate').value=res.data['rows']['email'];
           document.getElementById('adminMobileUpdate').value=res.data['rows']['mobile'];

           const roles = res.data['rows']['allRoles']
           const roleIds = res.data['rows']['roleIds']
            if (roles) {
                let options = `<option value="">Select</option>`
                for (const roleId in roles) {
                    options += `<option value="${roleId}" ${roleIds.indexOf(parseInt(roleId)) != -1 ? 'selected' :''}>${roles[roleId]}</option>`
                }
                document.getElementById('adminRoleUpdate').innerHTML=options;
            }
       }catch (e) {
           unauthorized(e.response.status)
       }
    }




    async function Update() {

       try {
            // return console.log(document.getElementById('updateID').value);
            let data = {
                id:  document.getElementById('updateID').value,
                firstName: document.getElementById('adminFirstNameUpdate').value,
                lastName: document.getElementById('adminLastNameUpdate').value,
                email: document.getElementById('adminEmailUpdate').value,
                mobile: document.getElementById('adminMobileUpdate').value,
                roleId: document.getElementById('adminRoleUpdate').value,
                updateID:  document.getElementById('updateID').value,
            };

           document.getElementById('update-modal-close').click();
           showLoader();
           let res = await axios.post("/api/update-admin",data,HeaderToken())
           hideLoader();
        //    return console.log(res);

           if(res.data['status']==="success"){
               document.getElementById("update-form").reset();
               successToast(res.data['message'])
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
