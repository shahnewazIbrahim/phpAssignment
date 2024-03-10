<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>About</h4>
                </div>
                <div class="align-items-center col" id="createButton">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0  bg-gradient-primary">Create</button>
                </div>
            </div>
            {{-- {{ asset($data->banner) }} --}}
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>Banner</th>
                    <th>History</th>
                    <th>vision</th>
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

    try {
        showLoader();
        let res=await axios.get("/api/list-about",HeaderToken());
        hideLoader();
        let tableList=$("#tableList");
        let tableData=$("#tableData");
        // console.log(window.location.origin);
        tableData.DataTable().destroy();
        tableList.empty();
        if(res.data['rows'].length) {
            console.log(res.data['rows'].length);

            document.getElementById('createButton').style.display = 'none';
        }

        res.data['rows'].forEach(function (item,index) {
            let row=`<tr>
                    <td><img src="${window.location.origin}/${item['banner']}" style="max-width: 100px;"/></td>
                    <td>
                        ${item['company_history'].length > 50 ? item['company_history'].substring(0,50) + '...' : item['company_history']}
                    </td>
                    <td>
                        ${item['our_vision'].length > 50 ? item['our_vision'].substring(0,50) + '...' : item['our_vision']}
                    </td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                    </td>
                 </tr>`
            tableList.append(row)
        })

        $('.editBtn').on('click', async function () {
            let id= $(this).data('id');
            await FillUpUpdateForm(id)
            $("#update-modal").modal('show');
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
    }catch (e) {
        unauthorized(e.response.status)
    }

}


</script>

