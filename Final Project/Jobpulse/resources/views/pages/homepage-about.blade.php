@extends('layout.app')

@section('content')
<section class="jp-hero">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <div class="jp-hero-content">
                <span class="jp-eyebrow">About JobPulse</span>
                <h1>We make hiring feel more structured, human, and visible.</h1>
                <p>From employer setup to candidate application, JobPulse is designed to reduce confusion and keep recruitment actions simple.</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div id="banner" class="jp-hero-media d-flex justify-content-center">
                <div class="spinner-border text-light" role="status"></div>
            </div>
        </div>
    </div>
</section>

<section class="jp-section">
    <div class="jp-grid jp-grid-2">
        <div class="jp-panel jp-prose" id="companyHistory">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
        <div class="jp-panel jp-prose" id="ourVision">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
    </div>
</section>

<section class="jp-section">
    <div class="jp-section-heading">
        <div>
            <h2>Companies Believe In Us</h2>
            <p>Employer accounts already using the platform to publish roles and manage applications.</p>
        </div>
    </div>
    <div class="jp-grid jp-grid-3" id="companySection">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
</section>

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
                 class="jp-banner-image"
                 alt="About banner" />
        `;
        document.getElementById('companyHistory').innerHTML = `
            <div class="jp-eyebrow text-dark" style="background: var(--jp-surface-soft); color: var(--jp-primary-deep);">Company History</div>
            <h3 class="mt-3">How JobPulse started</h3>
            <p>${res.data['about']['company_history']}</p>`;
        document.getElementById('ourVision').innerHTML = `
            <div class="jp-eyebrow text-dark" style="background: var(--jp-surface-soft); color: var(--jp-primary-deep);">Our Vision</div>
            <h3 class="mt-3">Where we want to go</h3>
            <p>${res.data['about']['our_vision']}</p>`;

        res.data['company'].forEach(function(item) {
            const initials = (item['firstName'] || 'J').slice(0, 2).toUpperCase();
            companyContainer += `
                <div class="jp-company-card">
                    <div class="jp-company-badge">${initials}</div>
                    <h4>${item['firstName']}</h4>
                    <p>Employer account on JobPulse with active recruitment workflows.</p>
                </div>`;
        });

        document.getElementById('companySection').innerHTML = companyContainer;

    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
@endsection
