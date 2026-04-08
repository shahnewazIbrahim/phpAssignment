<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>JobPulse Dashboard</title>

    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/toastify.min.css')}}" rel="stylesheet" />
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/toastify-js.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/dashboard') }}" data-async-nav="true">
            <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2" src="{{asset('images/menu.svg')}}" alt="menu"/>
            </span>
            <div>
                <div class="fs-5 text-primary fw-bold">JobPulse</div>
                <div class="small text-secondary">Admin Workspace</div>
            </div>
        </a>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt="user"/>
                <div class="user-dropdown-content">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt="user"/>
                        <h6 id="userName">User Name</h6>
                        <hr class="user-dropdown-divider p-0"/>
                    </div>
                    <a href="{{url('/dashboard')}}" class="side-bar-item" data-async-nav="true">
                        <span class="side-bar-item-caption">Dashboard</span>
                    </a>
                    <a href="{{url('/userProfile')}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    <div onclick="logout()" class="side-bar-item cursor-pointer">
                        <span class="side-bar-item-caption">Logout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="sideNavRef" class="side-nav-open">
    <div class="px-3 pb-3">
        <div class="jp-panel p-3">
            <div class="small text-uppercase text-secondary fw-bold mb-2">Workspace</div>
            <div class="fw-bold text-dark" id="menuRoleLabel">Loading role...</div>
            <div class="small text-secondary mt-1">Menus appear according to assigned roles and active plugins.</div>
        </div>
    </div>

    <nav id="dashboardMenu">
        <a href="{{url('/dashboard')}}" class="side-bar-item {{ request()->segment(1) == 'dashboard' ? 'side-bar-item-active' : '' }}" data-async-nav="true">
            <i class="bi bi-grid-1x2-fill side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Dashboard</span>
        </a>

        <a href="{{url('users')}}" id="userOption" class="side-bar-item {{ request()->segment(1) == 'users' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-people-fill side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Users</span>
        </a>

        <a href="{{url('/admin/role')}}" id="rolesOption" class="side-bar-item {{ request()->segment(2) == 'role' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-shield-check side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Roles</span>
        </a>

        <a href="{{url('/admin/employee')}}" id="employesOption" class="side-bar-item {{ request()->segment(2) == 'employee' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-person-badge side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Employees</span>
        </a>

        <a href="{{url('/admin/job')}}" id="jobsOption" class="side-bar-item {{ request()->segment(2) == 'job' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-briefcase-fill side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Jobs</span>
        </a>

        <a href="{{url('/admin/applied-job')}}" id="appliedJobsOption" class="side-bar-item {{ request()->segment(2) == 'applied-job' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-send-check side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Applied Jobs</span>
        </a>

        <a href="{{url('/admin/candidate-profile')}}" id="candidateProfileOption" class="side-bar-item {{ request()->segment(2) == 'candidate-profile' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-person-vcard side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Candidate Profile</span>
        </a>

        <a href="{{url('/admin/about')}}" id="aboutOption" class="side-bar-item {{ request()->segment(2) == 'about' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-info-circle-fill side-bar-item-icon"></i>
            <span class="side-bar-item-caption">About</span>
        </a>

        <a href="{{url('/admin/blog')}}" id="blogOption" class="side-bar-item {{ request()->segment(2) == 'blog' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-journal-richtext side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Blog</span>
        </a>

        <a href="{{url('/admin/plugin')}}" id="pluginOption" class="side-bar-item {{ request()->segment(2) == 'plugin' ? 'side-bar-item-active' : '' }}" style="display:none" data-async-nav="true">
            <i class="bi bi-puzzle-fill side-bar-item-icon"></i>
            <span class="side-bar-item-caption">Plugin</span>
        </a>
    </nav>
</aside>

<main id="contentRef" class="content">
    @yield('content')
</main>

<script>
    window.AppEditors = window.AppEditors || {};

    function createEditorToolbarOptions() {
        return [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ color: [] }, { background: [] }],
            ['blockquote', 'code-block', 'link'],
            ['clean']
        ];
    }

    function initRichTextEditor(id) {
        const textarea = document.getElementById(id);

        if (!textarea) {
            return null;
        }

        const existing = window.AppEditors[id];
        if (existing && existing.container?.isConnected) {
            return existing;
        }

        if (existing && !existing.container?.isConnected) {
            delete window.AppEditors[id];
        }

        textarea.style.display = 'none';
        let host = textarea.nextElementSibling;

        if (!host || !host.classList.contains('jp-editor-host')) {
            host = document.createElement('div');
            host.className = 'jp-editor-host';
            textarea.insertAdjacentElement('afterend', host);
        }

        host.innerHTML = '';
        const container = document.createElement('div');
        container.className = 'jp-editor-surface';
        host.appendChild(container);

        const initialHtml = textarea.value || '';
        const quill = new Quill(container, {
            theme: 'snow',
            modules: {
                toolbar: createEditorToolbarOptions()
            }
        });

        if (initialHtml) {
            quill.clipboard.dangerouslyPasteHTML(initialHtml);
        }

        window.AppEditors[id] = { quill, textarea, host, container };
        return window.AppEditors[id];
    }

    function getRichTextEditor(id) {
        return initRichTextEditor(id)?.quill || null;
    }

    function getRichTextData(id) {
        const editor = getRichTextEditor(id);
        return editor ? editor.root.innerHTML : '';
    }

    function setRichTextData(id, html) {
        const editor = getRichTextEditor(id);
        if (!editor) {
            return;
        }

        editor.setContents([]);
        if (html) {
            editor.clipboard.dangerouslyPasteHTML(html);
        }
    }

    function clearRichTextData(id) {
        setRichTextData(id, '');
    }

    let activatedPlugins = [];
    let assignedRoles = [];
    getUser();
    bindAsyncDashboardNavigation();

    async function getUser() {
        try {
            showLoader();
            let res = await axios.get("/api/user-profile", HeaderToken());
            hideLoader();
            activatedPlugins = res.data.activated_plugins || [];
            assignedRoles = res.data.assignedRole || [];
            menuHandler(assignedRoles);
            document.getElementById('userName').innerText = res.data?.full_name;
            document.getElementById('menuRoleLabel').innerText = assignedRoles.join(', ') || 'No role assigned';
        } catch (e) {
            unauthorized(e.response.status);
        }
    }

    function menuHandler(roles) {
        if (roles.includes('Owner') || roles.includes('Company')) {
            document.getElementById('rolesOption').style.display = 'block';
            document.getElementById('employesOption').style.display = 'block';
            document.getElementById('jobsOption').style.display = 'block';
        }

        if (roles.includes('Owner')) {
            document.getElementById('pluginOption').style.display = 'block';
            document.getElementById('userOption').style.display = 'block';
            document.getElementById('aboutOption').style.display = 'block';
            document.getElementById('blogOption').style.display = 'block';
        }

        if (roles.includes('Candidate') || roles.includes('Company')) {
            document.getElementById('appliedJobsOption').style.display = 'block';
        }

        if (roles.includes('Company') && activatedPlugins.includes('Blog')) {
            document.getElementById('blogOption').style.display = 'block';
        }

        if (roles.includes('Candidate')) {
            document.getElementById('candidateProfileOption').style.display = 'block';
        }
    }

    async function logout() {
        try {
            await axios.get("/api/logout", HeaderToken());
            clearSessionAndStorage();
        } catch(e) {}
    }

    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');

        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }

    function bindAsyncDashboardNavigation(root = document) {
        root.querySelectorAll('[data-async-nav="true"]').forEach(link => {
            link.addEventListener('click', onAsyncNavClick);
        });
    }

    async function onAsyncNavClick(event) {
        const link = event.currentTarget;
        const url = link.getAttribute('href');

        if (!url || link.dataset.loading === 'true' || event.ctrlKey || event.metaKey || event.shiftKey) {
            return;
        }

        if (!url.startsWith('/') && !url.startsWith(window.location.origin)) {
            return;
        }

        event.preventDefault();
        await loadDashboardPage(url, true);
    }

    async function loadDashboardPage(url, pushState = false) {
        const content = document.getElementById('contentRef');

        try {
            content.classList.add('jp-content-loading');
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const html = await response.text();
            const parsed = new DOMParser().parseFromString(html, 'text/html');
            const nextContent = parsed.querySelector('#contentRef');

            if (!nextContent) {
                window.location.href = url;
                return;
            }

            content.innerHTML = nextContent.innerHTML;
            hydrateInlineScripts(content);
            bindAsyncDashboardNavigation(content);
            updateActiveMenu(url);

            if (pushState) {
                window.history.pushState({ url }, '', url);
            }
        } catch (error) {
            window.location.href = url;
        } finally {
            content.classList.remove('jp-content-loading');
        }
    }

    function hydrateInlineScripts(container) {
        const scripts = Array.from(container.querySelectorAll('script'));

        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');

            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });

            if (oldScript.src) {
                newScript.src = oldScript.src;
            } else {
                newScript.textContent = oldScript.textContent;
            }

            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    function updateActiveMenu(url) {
        const currentUrl = new URL(url, window.location.origin).pathname;

        document.querySelectorAll('#dashboardMenu .side-bar-item').forEach(link => {
            const linkUrl = new URL(link.getAttribute('href'), window.location.origin).pathname;
            link.classList.toggle('side-bar-item-active', linkUrl === currentUrl);
        });
    }

    window.addEventListener('popstate', async function(event) {
        const targetUrl = event.state?.url || window.location.pathname;
        await loadDashboardPage(targetUrl, false);
    });
</script>

</body>
</html>
