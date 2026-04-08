<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Feature Access</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Feature</label>
                                <select class="form-control" id="pluginSlug" onchange="syncPluginFeatureDetails()"></select>

                                <label class="form-label mt-2">Feature Name</label>
                                <input type="text" class="form-control" id="pluginName" readonly/>

                                <label class="form-label mt-2">Description</label>
                                <textarea class="form-control" id="pluginDescription" rows="4" readonly></textarea>

                                <label class="form-label mt-2">User</label>
                                <select class="form-control" id="pluginUser"></select>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn bg-gradient-success">Save</button>
                </div>
            </div>
    </div>
</div>

<script>
let featureCatalog = {};

getUsers();
getFeatureCatalog();

async function getFeatureCatalog() {
    try {
        let res = await axios.get("/api/list-plugin", HeaderToken());
        featureCatalog = res.data['catalog'] || {};
        let featureSelect = document.getElementById('pluginSlug');
        let options = `<option value="">Select feature</option>`;

        Object.entries(featureCatalog).forEach(([slug, description]) => {
            const readable = slug.replaceAll('_', ' ').replace(/\b\w/g, c => c.toUpperCase());
            options += `<option value="${slug}" data-name="${readable}" data-description="${description}">${readable}</option>`;
        });

        featureSelect.innerHTML = options;
    } catch (e) {
        unauthorized(e.response.status)
    }
}

function syncPluginFeatureDetails() {
    const featureSelect = document.getElementById('pluginSlug');
    const selectedOption = featureSelect.options[featureSelect.selectedIndex];

    document.getElementById('pluginName').value = selectedOption?.dataset?.name || '';
    document.getElementById('pluginDescription').value = selectedOption?.dataset?.description || '';
}

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
        let pluginSlug = document.getElementById('pluginSlug').value;
        let pluginDescription = document.getElementById('pluginDescription').value;
        let pluginUser = document.getElementById('pluginUser').value;
        document.getElementById('modal-close').click();

        let PostBody= {
            "name":pluginName,
            "slug":pluginSlug,
            "description":pluginDescription,
            "user_id":pluginUser,
        }

        showLoader();
        let res = await axios.post("/api/create-plugin",PostBody,HeaderToken())
        document.getElementById("save-form").reset();
        document.getElementById('pluginName').value = '';
        document.getElementById('pluginDescription').value = '';
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
