@extends('layout.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-center" role="alert" id="banner">
        </div>
    </div>
</div>

<div class="p-4">
    <h5 class="text-center pb-3 text-uppercase text-primary">Top Companies</h5>
    <div class="d-flex flex-wrap justify-content-center gap-3" id="companySection">
    </div>
</div>
<div class="p-4">
    <h5 class="text-center pb-3 text-uppercase text-primary">Recent Published Jobs</h5>
    <div class="d-flex justify-content-center">
        <div class="col-12 col-md-8" id="jobSection">
        </div>
    </div>
</div>

<script>
getAboutSetting();

async function getAboutSetting() {
    try {
        showLoader();
        let res = await axios.get("/api/get-about-setting", HeaderToken());
        hideLoader();
        document.getElementById('banner').innerHTML = `
            <img src="${window.location.origin}/${res.data['about']['banner']}" 
                 class="img-fluid rounded shadow-sm" 
                 style="width:100%; max-height:400px; object-fit:cover;" />
        `;
    } catch (e) {
        unauthorized(e.response.status);
    }
}

getHomepage();

async function getHomepage() {
    let companyContainer = '';
    let jobContainer = '';

    try {
        showLoader();
        let res = await axios.get("/api/get-homepage", HeaderToken());
        hideLoader();

        res.data['company'].forEach(function (item) {
            companyContainer += `
                <div class="card border-0 shadow-sm rounded" style="width: 16rem;">
                    <div class="card-body text-center">
                        <h6 class="card-title text-dark">${item['firstName']}</h6>
                    </div>
                </div>`;
        });
        document.getElementById('companySection').innerHTML = companyContainer;

        res.data['job'].forEach(function (item) {
            let specialities = '';

            item['specialities'].split(',').forEach((speciality) => {
                if (speciality) {
                    specialities += `<span class="badge bg-light text-dark border me-1">${speciality}</span>`;
                }
            });

            jobContainer += `
                <div class="card mb-3 border-0 shadow-sm rounded">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-secondary mb-2">${item['type']}</h6>
                            <div>${specialities}</div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-sm btn-outline-success me-2" onclick="applyJob(${item['id']})">Apply</button>
                            <a href="job/${item['id']}" class="btn btn-sm btn-outline-primary">Details</a>
                            <div class="text-muted mt-1">${item['salary']} tk.</div>
                        </div>
                    </div>
                </div>`;
        });

        document.getElementById('jobSection').innerHTML = jobContainer;
    } catch (e) {
        unauthorized(e.response.status);
    }
}

async function applyJob(jobId) {
    try {
        if (!getToken()) {
            return window.location.href = '/userLogin?type=Candidate';
        }
        if (confirm("Are you sure you want to apply for this job?")) {
            let PostBody = { "id": jobId };
            showLoader();
            await axios.post("/api/apply-job", PostBody, HeaderToken());
            hideLoader();
        }
    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
@endsection
