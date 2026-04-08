@extends('layout.app')

@section('content')
<section class="jp-hero">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <div class="jp-hero-content">
                <span class="jp-eyebrow">Smart Hiring Platform</span>
                <h1>Find better jobs and hire faster with a cleaner workflow.</h1>
                <p>JobPulse brings employers, candidates, and hiring teams into one modern recruitment experience with clearer job discovery and faster action.</p>
                <div class="jp-hero-actions">
                    <a href="{{ url('/job') }}" class="jp-btn-primary">Explore Jobs</a>
                    <a href="{{ url('/userRegistration?type=candidate') }}" class="jp-btn-secondary">Create Candidate Profile</a>
                </div>
                <div class="jp-hero-stats">
                    <div class="jp-stat-card">
                        <strong id="heroCompanies">0+</strong>
                        <span>Hiring companies</span>
                    </div>
                    <div class="jp-stat-card">
                        <strong id="heroJobs">0+</strong>
                        <span>Open positions</span>
                    </div>
                    <div class="jp-stat-card">
                        <strong>Fast</strong>
                        <span>Application workflow</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div id="banner" class="jp-hero-media d-flex justify-content-center">
                <div class="spinner-border text-light mt-4" role="status"></div>
            </div>
        </div>
    </div>
</section>

<section class="jp-section">
    <div class="jp-section-heading">
        <div>
            <h2>Trusted By Growing Teams</h2>
            <p>Companies using JobPulse to publish jobs, manage applicants, and keep hiring organized.</p>
        </div>
    </div>
    <div class="jp-grid jp-grid-3" id="companySection">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
</section>

<section class="jp-section">
    <div class="jp-section-heading">
        <div>
            <h2>Recent Published Jobs</h2>
            <p>Fresh openings with essential details visible upfront so candidates can decide faster.</p>
        </div>
        <a href="{{ url('/job') }}" class="jp-btn-secondary text-dark border border-secondary-subtle">View All Jobs</a>
    </div>
    <div class="jp-grid jp-grid-2" id="jobSection">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
</section>

<script>
getAboutSetting();

async function getAboutSetting() {
    try {
        showLoader();
        let res = await axios.get("/api/get-about-setting", HeaderToken());
        hideLoader();
        document.getElementById('banner').innerHTML = `
            <img src="${window.location.origin}/${res.data['about']['banner']}"
                 class="jp-banner-image"
                 alt="About banner" />
        `;
    } catch (e) {
        console.error('Homepage job load failed:', e);
        document.getElementById('jobSection').innerHTML = `
            <div class="jp-panel p-4">
                <h5 class="mb-2">Jobs could not be loaded</h5>
                <p class="mb-0">Please refresh the page or check the API response.</p>
            </div>
        `;
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

        document.getElementById('heroCompanies').innerText = `${res.data['company'].length}+`;
        document.getElementById('heroJobs').innerText = `${res.data['job'].length}+`;

        res.data['company'].forEach(function(item) {
            const initials = (item['firstName'] || 'J').slice(0, 2).toUpperCase();
            companyContainer += `
                <div class="jp-company-card">
                    <div class="jp-company-badge">${initials}</div>
                    <h4>${item['firstName']}</h4>
                    <p>Active employer account using JobPulse to manage recruitment and publish roles.</p>
                </div>`;
        });
        document.getElementById('companySection').innerHTML = companyContainer;

        res.data['job'].forEach(function(item) {
            let specialities = '';

            item['specialities'].split(',').forEach((speciality) => {
                if (speciality.trim()) {
                    specialities += `<span class="jp-chip">${speciality.trim()}</span>`;
                }
            });

            jobContainer += `
                <div class="jp-job-card">
                    <span class="jp-eyebrow text-dark" style="background: ${item['is_featured'] ? 'linear-gradient(135deg, #ffcb6b, #ff9f43)' : 'var(--jp-surface-soft)'}; color: ${item['is_featured'] ? '#1d2634' : 'var(--jp-primary-deep)'};">
                        ${item['is_featured'] ? 'Featured Job' : 'Now Hiring'}
                    </span>
                    <h4>${item['type']}</h4>
                    <p>Published by <strong>${item['user']['full_name']}</strong> with a clearly defined hiring brief.</p>
                    <div class="jp-chip-row">${specialities}</div>
                    <div class="jp-meta">
                        <span><strong>Salary:</strong> ${item['salary']} tk.</span>
                        <span><strong>Deadline:</strong> ${item['deadline'] ?? 'Open'}</span>
                    </div>
                    <div class="jp-inline-actions">
                        <button class="btn btn-primary btn-sm" onclick="applyJob(${item['id']})">Apply</button>
                        <a href="job/${item['id']}" class="btn btn-outline-primary btn-sm">Details</a>
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
            successToast('Applied successfully');
        }
    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
@endsection
