<div class="jp-section-heading">
    <div>
        <h2>Latest Blog Posts</h2>
        <p>Insights for candidates and employers with cleaner reading previews and faster navigation.</p>
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
        let res = await axios.get("/api/list-blog", HeaderToken());
        hideLoader();
        let html = '';
        let dataContainer = document.getElementById("dataContainer");

        res.data['rows'].forEach(function(item) {
            html += `
                <div class="jp-blog-card">
                    <span class="jp-eyebrow text-dark" style="background: var(--jp-surface-soft); color: var(--jp-primary-deep);">Article</span>
                    <h4>${item['user']['full_name']}</h4>
                    <p>${item['text'].replace(/<[^>]*>/g, '').substring(0, 140)}...</p>
                    <div class="jp-inline-actions">
                        <a href="blog/${item['id']}" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>`;
        });

        dataContainer.innerHTML = html;

    } catch (e) {
        unauthorized(e.response.status);
    }
}
</script>
