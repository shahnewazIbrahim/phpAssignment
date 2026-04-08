@extends('layout.app')
@section('content')
    <section class="jp-job-detail-hero">
        <div class="row g-4 align-items-center">
            <div class="col-lg-8">
                <span class="jp-eyebrow">Job Detail</span>
                <h1 id="type">Loading job title...</h1>
                <p id="jobIntro">Review the role overview, requirements, responsibilities, and application details before applying.</p>
                <div class="jp-meta">
                    <span><strong>Company:</strong> <span id="companyName">Loading...</span></span>
                    <span><strong>Location:</strong> <span id="location">Loading...</span></span>
                    <span><strong>Deadline:</strong> <span id="deadline">Loading...</span></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="jp-hero-stats">
                    <div class="jp-stat-card">
                        <strong id="salary">--</strong>
                        <span>Salary Range</span>
                    </div>
                    <div class="jp-stat-card">
                        <strong id="employeeStatus">--</strong>
                        <span>Employment Type</span>
                    </div>
                    <div class="jp-stat-card">
                        <strong id="specialityCount">0</strong>
                        <span>Core Skills</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="jp-section">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="jp-panel jp-detail-main">
                    <div class="jp-detail-section border-bottom">
                        <h3>Required Specialities</h3>
                        <ul id="specialties" class="jp-detail-list"></ul>
                    </div>
                    <div class="jp-detail-section border-bottom">
                        <h3>Requirements</h3>
                        <div id="requirements" class="jp-detail-html"></div>
                    </div>
                    <div class="jp-detail-section border-bottom">
                        <h3>Experience</h3>
                        <div id="experience" class="jp-detail-html"></div>
                    </div>
                    <div class="jp-detail-section">
                        <h3>Responsibilities</h3>
                        <div id="responsibilities" class="jp-detail-html"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="jp-panel jp-detail-sidebar">
                    <h3 class="mb-3">Quick Overview</h3>
                    <div class="jp-detail-facts">
                        <div class="jp-detail-fact">
                            <span class="label">Compensations</span>
                            <span class="value" id="compensations">Loading...</span>
                        </div>
                        <div class="jp-detail-fact">
                            <span class="label">Office Location</span>
                            <span class="value" id="locationAside">Loading...</span>
                        </div>
                        <div class="jp-detail-fact">
                            <span class="label">Published By</span>
                            <span class="value" id="companyNameAside">Loading...</span>
                        </div>
                    </div>
                    <div class="jp-inline-actions mt-4" id="applyJob"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        getDetail();

        async function getDetail() {
            let id = "{{ request()->segment(2) }}";
            let specialities = '';
            try {
                showLoader();
                let res = await axios.post("/api/job-detail", {
                    id: id.toString()
                }, HeaderToken());
                hideLoader();
                specialities = '';
                res.data['rows']['specialities'].split(',').forEach((speciality) => {
                    if (speciality.trim()) {
                        specialities += `<li class="jp-chip">${speciality.trim()}</li>`;
                    }
                });
                let button = res.data['rows']['is_applied_by_user'] 
                    ? `<button class="btn btn-success btn-lg w-100" disabled>Already Applied</button>`
                    : `<button class="btn btn-primary btn-lg w-100" onclick="applyJob(${res.data['rows']['id']})">Apply For This Job</button>`;
                document.getElementById('type').innerHTML = res.data['rows']['type'];
                document.getElementById('employeeStatus').innerHTML = res.data['rows']['employee_status'];
                document.getElementById('salary').innerHTML = res.data['rows']['salary'] + " tk.";
                document.getElementById('requirements').innerHTML = res.data['rows']['requirements'];
                document.getElementById('experience').innerHTML = res.data['rows']['experience'] || 'Not specified';
                document.getElementById('specialties').innerHTML = specialities;
                document.getElementById('specialityCount').innerHTML = res.data['rows']['specialities'].split(',').filter(item => item.trim()).length;
                document.getElementById('responsibilities').innerHTML = res.data['rows']['responsibilities'];
                document.getElementById('companyName').innerHTML = res.data['rows']['user']['full_name'];
                document.getElementById('companyNameAside').innerHTML = res.data['rows']['user']['full_name'];
                document.getElementById('location').innerHTML = res.data['rows']['location'];
                document.getElementById('locationAside').innerHTML = res.data['rows']['location'];
                document.getElementById('compensations').innerHTML = res.data['rows']['compensations'];
                document.getElementById('deadline').innerHTML = new Date(res.data['rows']['deadline'])
                    .toLocaleDateString();
                document.getElementById('applyJob').innerHTML = button;

            } catch (e) {
                console.error('Job detail load failed:', e);
                unauthorized(e.response.status);
            }
        }

        async function applyJob(jobId) {
            // return console.log(!getToken());
            try {
                if(!getToken()) {
                    return window.location.href = '/userLogin?type=Candidate'
                }
                if (confirm("Are you want to apply this post?")) {
                    let PostBody= {
                        "id":jobId,
                    }
                    showLoader();
                    let res = await axios.post("/api/apply-job",PostBody,HeaderToken())
                    hideLoader();
                    
                    if(res.data['status']==="success"){
                        successToast(res.data['message']);
                        getDetail();
                    }else{
                        errorToast(res.data['message']);
                    }
                }
                
            }catch (e) {
                unauthorized(e.response.status);
            }
        
        }
    </script>
@endsection
