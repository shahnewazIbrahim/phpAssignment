@extends('layout.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-center" role="alert" id="banner">
        </div>
    </div>
</div>

<div class="p-4">
    <h5 class="text-center pb-3 text-uppercase text-primary">Company History</h5>
    <div class="d-flex justify-content-center align-content-center">
        <div class="col-10">
            <div id="companyHistory" class="card border-0 shadow-sm rounded p-4 bg-light">
            </div>
        </div>
    </div>
</div>

<div class="p-4">
    <h5 class="text-center pb-3 text-uppercase text-primary">Our Vision</h5>
    <div class="d-flex justify-content-center align-content-center">
        <div class="col-10">
            <div id="ourVision" class="card border-0 shadow-sm rounded p-4 bg-light">
            </div>
        </div>
    </div>
</div>

<div class="p-4">
    <h5 class="text-center pb-3 text-uppercase text-primary">Companies Believe in Us</h5>
    <div class="d-flex flex-wrap justify-content-center gap-3" id="companySection">
    </div>
</div>

<script>
let companyContainer = '';

getAboutSetting();

async function getAboutSetting() {
    try {
        showLoader();
        let res = await axios.get("/api/get-about-setting");
        hideLoader();
        document.getElementById('banner').innerHTML = `
            <img src="${window.location.origin}/${res.data['about']['banner']}" 
                 class="img-fluid rounded shadow-sm" 
                 style="width:100%; max-height:400px; object-fit:cover;" />
        `;
        document.getElementById('companyHistory').innerHTML = `<p>${res.data['about']['company_history']}</p>`;
        document.getElementById('ourVision').innerHTML = `<p>${res.data['about']['our_vision']}</p>`;

        res.data['company'].forEach(function (item) {
            companyContainer += `
                <div class="card border-0 shadow-sm btn-secondary rounded" style="width: 16rem;">
                    <div class="card-body text-center">
                        <h6 class="card-title text-dark">${item['firstName']}</h6>
                    </div>
                </div>`;
        });

        document.getElementById('companySection').innerHTML = companyContainer;

    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
@endsection
