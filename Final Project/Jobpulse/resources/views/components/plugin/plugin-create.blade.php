<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Plugin</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="pluginName"/>

                                <label class="form-label mt-2">user</label>
                                <select type="text" class="form-control" id="pluginUser"></select>
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
getUsers();
async function getUsers() {
    let pluginUser = document.getElementById('pluginUser');
    let options = `<option value="">Select</option>`;
        try {
            showLoader();
            let res = await axios.get("/api/list-admin",HeaderToken())
            hideLoader();
            res.data['rows'].forEach(function (item,index) {
                options +=`<option value="${item['id']}">${item['full_name']}</option>`
            })
            pluginUser.innerHTML = options;
        }catch (e) {
            unauthorized(e.response.status)
        }
    }

    async function Save() {
        try {
            

            let pluginName = document.getElementById('pluginName').value;
            // let pluginActive = document.getElementById('pluginActive').value;
            let pluginUser = document.getElementById('pluginUser').value;
            document.getElementById('modal-close').click();

            let PostBody= {
                "name":pluginName,
                // "active":pluginActive,
                "user_id":pluginUser,
            }

            showLoader();
            let res = await axios.post("/api/create-plugin",PostBody,HeaderToken())
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
