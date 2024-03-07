<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Job</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Type</label>
                                <input type="text" class="form-control" id="jobTypeUpdate">
                                <label class="form-label mt-2">Specialities</label>
                                <input type="text" class="form-control" id="jobSpecialitiesUpdate">
                                <label class="form-label mt-2">Deadline</label>
                                <input type="date" class="form-control" id="jobDeadlineUpdate">
                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>



    async function FillUpUpdateForm(id){
        try {
            document.getElementById('updateID').value=id;
            showLoader();
            let res=await axios.post("/api/job-by-id",{id:id.toString()},HeaderToken())
            hideLoader();
            document.getElementById('jobTypeUpdate').value=res.data['rows']['type'];
            document.getElementById('jobSpecialitiesUpdate').value=res.data['rows']['specialities'];
            document.getElementById('jobDeadlineUpdate').value=res.data['rows']['deadline'];
        }catch (e) {
            unauthorized(e.response.status)
        }
    }



    async function update() {

        try {
            let jobTypeUpdate=document.getElementById('jobTypeUpdate').value;
            let jobSpecialitiesUpdate=document.getElementById('jobSpecialitiesUpdate').value;
            let jobDeadlineUpdate=document.getElementById('jobDeadlineUpdate').value;
            let updateID=document.getElementById('updateID').value;
            document.getElementById('update-modal-close').click();
            
            // return console.log(343);
            let PostBody= {
                "type":jobTypeUpdate,
                "specialities":jobSpecialitiesUpdate,
                "deadline":jobDeadlineUpdate,
                "id":updateID
            }

            showLoader();
            let res = await axios.post("/api/update-job",PostBody,HeaderToken())
            hideLoader();
            if(res.data['status']==="success"){
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
