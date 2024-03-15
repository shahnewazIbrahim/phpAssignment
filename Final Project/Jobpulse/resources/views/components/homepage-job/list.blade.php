<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <h4 class="text-center">All Jobs</h4>
            <hr class="bg-dark">
            <div class="d-flex justify-content-center align-items-center gap-3" id="dataContainer">
            
            </div>
        </div>
    </div>
</div>
</div>

<script>

getList();


async function getList() {

    try {
        showLoader();
        let res=await axios.get("/api/list-job",HeaderToken());
        hideLoader();
        let html = ''
        let dataContainer=document.getElementById("dataContainer");

        res.data['rows'].forEach(function (item,index) {
            html += `
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">${item['type']}</h5>
                        <p class="card-text">Salary -${item['salary']}</p>
                        <p class="card-text">${item['specialities']}</p>
                        <p class="card-text">Offered By- <b>${item['user']['full_name']}</b></p>
                        <div class="my-5">
                            <a href="job/${item['id']}" class="btn btn-primary stretched-link">Details</a>
                        </div>
                    </div>
                </div>
                `
        })
        dataContainer.innerHTML = html

    }catch (e) {
        unauthorized(e.response.status)
    }

}


</script>

