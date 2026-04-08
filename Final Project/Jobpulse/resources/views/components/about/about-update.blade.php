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
                                <label class="form-label mt-2">Banner</label>
                                <input type="file" class="form-control" id="aboutBannerUpdate" accept="image/*">
                                <label class="form-label mt-2">Company History</label>
                                <textarea type="text" class="form-control" id="aboutCompanyHistoryUpdate"></textarea>
                                <label class="form-label mt-2">Our Vision</label>
                                <textarea type="text" class="form-control" id="aboutOurVisionUpdate"></textarea>
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
initRichTextEditor('aboutCompanyHistoryUpdate');
initRichTextEditor('aboutOurVisionUpdate');
    async function FillUpUpdateForm(id){
        try {
            document.getElementById('updateID').value=id;
            showLoader();
            let res=await axios.post("/api/about-by-id",{id:id.toString()},HeaderToken())
            hideLoader();
            document.getElementById('preview').innerHTML=`
                <img src="${window.location.origin}/${res.data['rows']['banner']}" style="max-width: 100px;"/>
            `;

            document.getElementById('aboutBannerUpdate').value = '';
            setRichTextData('aboutCompanyHistoryUpdate', res.data['rows']['company_history']);
            setRichTextData('aboutOurVisionUpdate', res.data['rows']['our_vision']);
        }catch (e) {
            unauthorized(e.response.status)
        }
    }



    async function update() {
        try {
            let aboutBannerUpdate = document.getElementById('aboutBannerUpdate').files[0];
            let aboutCompanyHistoryUpdate = getRichTextData('aboutCompanyHistoryUpdate');
            let aboutOurVisionUpdate = getRichTextData('aboutOurVisionUpdate');
            let updateID = document.getElementById('updateID').value;
            document.getElementById('update-modal-close').click();

            let formData = new FormData();
            if (aboutBannerUpdate) {
                formData.append('banner', aboutBannerUpdate);
            }
            formData.append('companyHistory', aboutCompanyHistoryUpdate);
            formData.append('ourVision', aboutOurVisionUpdate);
            formData.append('id', updateID);

            showLoader();
            let res = await axios.post("/api/update-about",formData,HeaderToken())
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
