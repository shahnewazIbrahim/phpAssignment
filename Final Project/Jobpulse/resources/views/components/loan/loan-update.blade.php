<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Loan</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="loanNameUpdate">
                                <label class="form-label">Type *</label>
                                <select type="text" class="form-select" id="loanTypeUpdate"></select>
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
           let res=await axios.post("/api/loan-by-id",{id:id},HeaderToken())
           hideLoader();

           document.getElementById('loanNameUpdate').value=res.data['rows']['name'];
           const html = `
           <option value="Business" ${res.data['rows']['type'] == "Business" ? 'selected' : ''}>Business</option>
           <option value="Personal" ${res.data['rows']['type'] == "Personal" ? 'selected' : ''}>Personal</option>
           `
           document.getElementById('loanTypeUpdate').innerHTML= html;
       }catch (e) {
           unauthorized(e.response.status)
       }
    }




    async function Update() {

       try {
            // return console.log(document.getElementById('updateID').value);
            let data = {
                id:  document.getElementById('updateID').value,
                name: document.getElementById('loanNameUpdate').value,
                type: document.getElementById('loanTypeUpdate').value,
                updateID:  document.getElementById('updateID').value,
            };

           document.getElementById('update-modal-close').click();
           showLoader();
           let res = await axios.post("/api/update-loan",data,HeaderToken())
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
