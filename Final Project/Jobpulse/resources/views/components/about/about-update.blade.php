<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update About</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div id="preview"></div>
                                <label class="form-label mt-2">Type</label>
                                <input type="file" class="form-control" id="aboutBannerUpdate">
                                <label class="form-label mt-2">Company History</label>
                                <input type="text" class="form-control" id="aboutCompanyHistoryUpdate">
                                <label class="form-label mt-2">Our Vision</label>
                                <input type="text" class="form-control" id="aboutOurVisionUpdate">
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
            let res=await axios.post("/api/about-by-id",{id:id.toString()},HeaderToken())
            hideLoader();
            console.log(res.data['rows']['banner']);
            document.getElementById('preview').innerHTML=`
                <img src="${window.location.origin}/${res.data['rows']['banner']}" style="max-width: 100px;"/>
            `;
            // document.getElementById('aboutBannerUpdate').value=res.data['rows']['banner'];
            // document.getElementById('aboutCompanyHistoryUpdate').value=res.data['rows']['company_history'];
            // document.getElementById('aboutOurVisionUpdate').value=res.data['rows']['our_vision'];
        }catch (e) {
            unauthorized(e.response.status)
        }
    }



    async function update() {

        try {
            let aboutTypeUpdate=document.getElementById('aboutTypeUpdate').value;
            let aboutSpecialitiesUpdate=document.getElementById('aboutSpecialitiesUpdate').value;
            let aboutDeadlineUpdate=document.getElementById('aboutDeadlineUpdate').value;
            let updateID=document.getElementById('updateID').value;
            document.getElementById('update-modal-close').click();
            
            // return console.log(343);
            let PostBody= {
                "type":aboutTypeUpdate,
                "specialities":aboutSpecialitiesUpdate,
                "deadline":aboutDeadlineUpdate,
                "id":updateID
            }

            showLoader();
            let res = await axios.post("/api/update-about",PostBody,HeaderToken())
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
