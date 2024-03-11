<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create About</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Banner</label>
                                <input type="file" class="form-control" id="aboutBanner">

                                <label class="form-label mt-2">Company History</label>
                                <textarea type="text" class="form-control" name="companyHistory" id="aboutCompanyHistory"></textarea>

                                <label class="form-label mt-2">Our Vision</label>
                                <textarea type="date" class="form-control" name="ourVision" id="aboutOurVision"></textarea>

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
CKEDITOR.replace( 'aboutCompanyHistory');
CKEDITOR.replace( 'aboutOurVision');


    async function Save() {
        try {
            let companyHistoryEditor = CKEDITOR.instances['aboutCompanyHistory'];
            let ourVisionEditor = CKEDITOR.instances['aboutOurVision'];

            let aboutBanner=document.getElementById('aboutBanner').files[0];
            let aboutCompanyHistory = companyHistoryEditor.getData();
            let aboutOurVision = ourVisionEditor.getData();
            
            document.getElementById('modal-close').click();

            let formData = new FormData();
            formData.append('banner', aboutBanner); // Append the image file
            formData.append('companyHistory', aboutCompanyHistory);
            formData.append('ourVision', aboutOurVision);

            // let PostBody= {
            //     "banner":aboutBanner,
            //     "companyHistory":aboutCompanyHistory,
            //     "ourVision":aboutOurVision,
            // }

            showLoader();
            let res = await axios.post("/api/create-about",formData,HeaderToken())
            document.getElementById("save-form").reset();
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
