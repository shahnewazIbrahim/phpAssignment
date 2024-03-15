<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <hr class="bg-dark "/>
            <div class="d-flex justify-content-center gap-3" id="dataContainer">
                
            </div>
        </div>
    </div>
</div>
</div>

<script>

getList();


async function getList() {

    // try {
        showLoader();
        let res=await axios.get("/api/list-blog",HeaderToken());
        hideLoader();
        let html = ''
        let dataContainer=document.getElementById("dataContainer");

        res.data['rows'].forEach(function (item,index) {
            html += `
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Written By -${item['user']['full_name']}</h5>
                        <p class="card-text">${item['text'].length > 50 ? item['text'].substring(0,50) + '...' : item['text']}</p>
                    </div>
                    <a href="blog/${item['id']}" class="btn btn-primary stretched-link">Details</a>
                </div>
                `
        })
        dataContainer.innerHTML = html

    // }catch (e) {
    //     unauthorized(e.response.status)
    // }

}


</script>

