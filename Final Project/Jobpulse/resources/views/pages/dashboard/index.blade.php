@extends('layout.sidenav-layout')

@section('content')
<div class="container-fluid">
    <div class="jp-admin-header">
        <h1>Dashboard Overview</h1>
        <p>Track hiring activity, employee data, and published jobs from one workspace.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="jp-admin-stat">
                <div class="stat-kicker">Applications</div>
                <div class="stat-value" id="applyJob">0</div>
                <p class="stat-note">Candidate submissions currently tracked in the system.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jp-admin-stat">
                <div class="stat-kicker">Employees</div>
                <div class="stat-value" id="employee">0</div>
                <p class="stat-note">Internal staff records available for management.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jp-admin-stat">
                <div class="stat-kicker">Jobs</div>
                <div class="stat-value" id="job">0</div>
                <p class="stat-note">Active and published roles visible on the platform.</p>
            </div>
        </div>
    </div>

    <div class="jp-panel jp-admin-panel mt-4">
        <h4 class="mb-2">How this dashboard is now structured</h4>
        <p class="mb-0">Sidebar items are shown according to role and plugin access. Menu click now uses async content loading, so the full admin shell does not reload on every navigation.</p>
    </div>
</div>

<script>
getList();

async function getList() {
    try {
        showLoader();
        let res = await axios.get("/api/count-properties", HeaderToken());
        hideLoader();

        $("#applyJob").text(res.data["data"]["applyJobCount"]);
        $("#employee").text(res.data["data"]["employeeCount"]);
        $("#job").text(res.data["data"]["jobCount"]);

    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
@endsection
