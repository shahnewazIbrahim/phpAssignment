<div class="jp-section-heading">
    <div>
        <h2>Browse Open Roles</h2>
        <p>A cleaner job directory with quick salary, company, and speciality context before you open details.</p>
    </div>
</div>

<div class="jp-grid jp-grid-2" id="dataContainer">
    <div class="spinner-border text-primary" role="status"></div>
</div>

<script>
getList();

async function getList() {
    try {
        showLoader();
        let res = await axios.get("/api/list-job", HeaderToken());
        hideLoader();
        let html = '';
        let dataContainer = document.getElementById("dataContainer");

        res.data['rows'].forEach(function(item) {
            let chips = '';
            item['specialities'].split(',').forEach(function(speciality) {
                if (speciality.trim()) {
                    chips += `<span class="jp-chip">${speciality.trim()}</span>`;
                }
            });

            html += `
                <div class="jp-job-card">
                    <span class="jp-eyebrow text-dark" style="background: var(--jp-surface-soft); color: var(--jp-primary-deep);">Open Role</span>
                    <h4>${item['type']}</h4>
                    <p>Posted by <strong>${item['user']['full_name']}</strong>.</p>
                    <div class="jp-chip-row">${chips}</div>
                    <div class="jp-meta">
                        <span><strong>Salary:</strong> ${item['salary']}</span>
                        <span><strong>Status:</strong> ${item['employee_status'] ?? 'Not specified'}</span>
                        <span><strong>Location:</strong> ${item['location'] ?? 'Not specified'}</span>
                    </div>
                    <div class="jp-inline-actions">
                        <a href="job/${item['id']}" class="btn btn-primary btn-sm">Details</a>
                    </div>
                </div>`;
        });

        dataContainer.innerHTML = html;

    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
