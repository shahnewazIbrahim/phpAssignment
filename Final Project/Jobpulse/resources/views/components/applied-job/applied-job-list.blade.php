<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Applied job</h4>
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
                    <th>JobID</th>
                    <th>Applicant</th>
                    <th>Company</th>
                    <th>AppliedAt</th>
                    <th id="action">Action</th>
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
        let res=await axios.get("/api/list-applied-job",HeaderToken());
        hideLoader();
        let tableList=$("#tableList");
        let tableData=$("#tableData");
        console.log(res.data);
        tableData.DataTable().destroy();
        tableList.empty();
        if(res.data['rows'].length) {
            // console.log(res.data['rows'].length);

            document.getElementById('createButton').style.display = 'none';
        }

        res.data['rows'].forEach(function (item,index) {
            let row=`<tr>
                    <td>${item['job_id']}</td>
                    <td>
                        ${item['applicant']['full_name']}
                    </td>
                    <td>
                        ${item['job']['user']['full_name']}
                    </td>
                    <td>
                        ${new Date(item['created_at']).toLocaleDateString()}
                    </td>
                    <td>
                        <button data-id="${item['id']}" class="btn acceptBtn ${item['accept'] ? 'btn-success' : 'btn-outline-success'} btn-sm btn-outline-success"
                        style="display: ${item['can_accept'] ? '' : 'none'} "
                        onclick="acceptJob(${item['id']}, ${item['accept']})"
                        >${item['accept'] ? 'Accepted' : 'Accept'}</button>
                        <button data-id="${item['id']}" class="btn btn-sm ${item['accept'] ? 'btn-outline-success' : 'btn-outline-danger'} btn-outline-success"
                        style="display: ${item['can_accept'] ? 'none' : ''} "
                        >${item['accept'] ? 'Accepted' : 'Not Accepted'}</button>

                        <a href="/admin/view-profile/${item['user_id']}" class="btn profileShow btn-sm btn-outline-danger"
                        >View Profile</a>
                    </td>
                 </tr>`
                //  document.getElementById('action').style.display = item['can_accept'] ? '' : 'none'
            tableList.append(row)
        })

        // $('.acceptBtn').on('click', async function () {
        //     let id= $(this).data('id');
        //     await FillUpUpdateForm(id)
        //     $("#update-modal").modal('show');
        // })

        $('.profileShow').on('click',function () {
            let id= $(this).data('id');
            
        })
        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });
    }catch (e) {
        unauthorized(e.response.status)
    }

}

async function acceptJob(id, accepted) {
            if (accepted) {
                return ;
            }
            try {
                if (confirm("Are You Sure?")) {
                    let res=await axios.post("/api/accept-applied-job", {
                        id:id
                    }, HeaderToken());
                    
                    getList();
                }
            } catch (e) {
                unauthorized(e.response.status)
            }


    }


</script>

