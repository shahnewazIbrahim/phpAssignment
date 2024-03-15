<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Plugin</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>Name</th>
                    <th>Active</th>
                    <th>Can Use</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>

getList();

async function getList() {

    // try {
        showLoader();
        let res=await axios.get("/api/list-plugin",HeaderToken());
        hideLoader();

        let tableList=$("#tableList");
        let tableData=$("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data['rows'].forEach(function (item,index) {
            let row=`<tr>
                    <td>${item['name']}</td>
                    <td>${item['active']? 'Yes' : 'No'}</td>
                    <td>${item['user']['full_name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn ${item['active']? 'btn-success' : 'activeBtn btn-outline-danger'} btn-sm">${item['active']? 'Activated' : 'Active'}</button>
                    </td>
                 </tr>`
            tableList.append(row)
        })

        $('.activeBtn').on('click', async function () {
            let id= $(this).data('id');
            showLoader();
            let res=await axios.post("/api/acitve-plugin",{id:id.toString()},HeaderToken());
            hideLoader();
            if(res.data['status']==="success"){
                successToast(res.data['message'])
                await getList();
            }
            else{
                errorToast(res.data['message'])
            }
        })

        $('.deleteBtn').on('click',function () {
            let id= $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        })
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });
    // }catch (e) {
    //     unauthorized(e.response.status)
    // }

}


</script>

