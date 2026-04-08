<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between">
                <div class="align-items-center col">
                    <h4>Feature Access</h4>
                    <p class="text-secondary mb-0">Assign optional modules to companies and turn them on or off from here.</p>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Assign Feature</button>
                </div>
            </div>
            <hr class="bg-dark"/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList"></tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
getList();

async function getList() {
    try {
        showLoader();
        let res = await axios.get("/api/list-plugin",HeaderToken());
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        if ($.fn.DataTable.isDataTable('#tableData')) {
            tableData.DataTable().destroy();
        }

        tableList.empty();

        res.data['rows'].forEach(function (item,index) {
            let row = `<tr>
                    <td>${item['name']}</td>
                    <td><code>${item['normalized_slug']}</code><div class="small text-secondary mt-1">${item['description'] ?? ''}</div></td>
                    <td>${item['user']['full_name']}</td>
                    <td>${item['active'] ? '<span class="badge bg-success">Enabled</span>' : '<span class="badge bg-secondary">Disabled</span>'}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn activeBtn ${item['active'] ? 'btn-success' : 'btn-outline-danger'} btn-sm">${item['active'] ? 'Disable' : 'Enable'}</button>
                    </td>
                 </tr>`;
            tableList.append(row)
        });

        $('.activeBtn').on('click', async function () {
            let id = $(this).data('id');
            showLoader();
            let res = await axios.post("/api/acitve-plugin",{id:id.toString()},HeaderToken());
            hideLoader();
            if(res.data['status']==="success"){
                successToast(res.data['message'])
                await getList();
            }
            else{
                errorToast(res.data['message'])
            }
        });

        new DataTable('#tableData',{
            order:[[0,'asc']],
            lengthMenu:[5,10,15,20,30]
        });
    } catch (e) {
        unauthorized(e.response.status)
    }
}
</script>
