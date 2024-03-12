<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Blog</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label mt-2">Text</label>
                                <textarea type="text" class="form-control" name="text" id="text"></textarea>

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
CKEDITOR.replace( 'text');


    async function Save() {
        try {
            let text = CKEDITOR.instances['text'];

            let textContent = text.getData();
            
            document.getElementById('modal-close').click();

            let formData = new FormData();
            formData.append('text', textContent);

            // let PostBody= {
            //     "banner":blogBanner,
            //     "companyHistory":blogCompanyHistory,
            //     "ourVision":blogOurVision,
            // }

            showLoader();
            let res = await axios.post("/api/create-blog",formData,HeaderToken())
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
