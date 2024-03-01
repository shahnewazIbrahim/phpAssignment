<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="roleNameUpdate">
                                <label class="form-label">Guard *</label>
                                <input type="text" class="form-control" id="roleSlugUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Permission *</label>
                                <div class="d-flex flex-wrap gap-4" id="updatePermisson">
                            
                                </div>
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


    let checkedPermission= [];
   async function FillUpUpdateForm(id){
       try {
           document.getElementById('updateID').value=id;
           showLoader();
           let res=await axios.post("/api/role-by-id",{id:id},HeaderToken())
           hideLoader();
        //    return console.log(res.data)

           document.getElementById('roleNameUpdate').value=res.data['rows']['name'];
           document.getElementById('roleSlugUpdate').value=res.data['rows']['guard_name'];
           let allPermission = res.data['rows']['allPermission']
           let html = '';
            for (const id in allPermission) {

                res.data['rows']['slected_permissions'].includes(parseInt(id))
                ? checkedPermission.push(parseInt(id)) 
                : '';

                html +=`
                    <label class="cursor-pointer" for="permission${id}" onclick="permissionCheck(${id})">
                        <input id="permission${id}" type="checkbox" value="${id}" ${res.data['rows']['slected_permissions'].includes(parseInt(id))? 'checked' : ''}>
                        ${allPermission[id]}
                    </label>
                `
            }
            document.getElementById('updatePermisson').innerHTML=html;
        }catch (e) {
           unauthorized(e.response.status)
       }
    }


    function permissionCheck (id) {
        
        if (checkedPermission.indexOf(id) == -1) {
            
            checkedPermission.push(parseInt(id))
        }
        // else{
        //   let index =   checkedPermission.indexOf(id)
        //   checkedPermission.splice(index,1)
        // }
        // console.log(checkedPermission);
    }

    async function Update() {

       try {
            // return console.log(document.getElementById('updateID').value);
            let data = {
                id:  document.getElementById('updateID').value,
                name: document.getElementById('roleNameUpdate').value,
                guard: document.getElementById('roleSlugUpdate').value,
                permissions: checkedPermission,
                updateID:  document.getElementById('updateID').value,
            };

           document.getElementById('update-modal-close').click();
           showLoader();
           let res = await axios.post("/api/update-role",data,HeaderToken())
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
           unauthorized(e.response?.status)
       }
    }



</script>
