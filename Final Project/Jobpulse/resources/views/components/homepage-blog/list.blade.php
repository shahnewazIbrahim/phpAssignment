<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5 border-0 shadow-sm rounded">
                <h5 class="text-center pb-3 text-uppercase text-primary">Blog List</h5>
                <hr class="bg-dark" />
                <div class="d-flex flex-wrap justify-content-center gap-4" id="dataContainer">
                    <div class="spinner-border text-primary" role="status">
                
                    </div>
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
        let res = await axios.get("/api/list-blog", HeaderToken());
        hideLoader();
        let html = '';
        let dataContainer = document.getElementById("dataContainer");

        res.data['rows'].forEach(function (item) {
            html += `
                <div class="card border-0 shadow-sm rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h6 class="card-title text-primary">Written By - ${item['user']['full_name']}</h6>
                        <p class="card-text text-secondary">${item['text'].length > 50 ? item['text'].substring(0, 50) + '...' : item['text']}</p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-center">
                        <a href="blog/${item['id']}" class="btn btn-sm btn-primary">Details</a>
                    </div>
                </div>`;
        });

        dataContainer.innerHTML = html;

    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
