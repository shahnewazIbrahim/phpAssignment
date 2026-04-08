<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>JobPulse</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/toastify-js.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
    <div class="jp-shell">
        <div id="loader" class="LoadingOverlay d-none">
            <div class="Line-Progress">
                <div class="indeterminate"></div>
            </div>
        </div>

        <header class="jp-navbar py-3">
            <div class="container">
                <div class="jp-header-shell">
                    <a href="{{ url('/') }}" class="jp-brand-wrap text-white text-decoration-none">
                        <img class="jp-brand-mark" src="{{ asset('images/jobpulseLogo.webp') }}" alt="JobPulse logo">
                        <div class="jp-brand-copy">
                            <span class="jp-brand-kicker">Hiring Platform</span>
                            <span class="navbar-brand-text">JobPulse</span>
                        </div>
                    </a>

                    <div class="jp-header-center">
                        <ul class="nav col-12 col-lg-auto justify-content-center jp-nav-links jp-header-pill">
                            <li class="nav-item">
                                <a href="{{ url('/') }}"
                                    class="nav-link jp-nav-link {{ request()->segment(1) == '' ? 'is-active' : '' }}">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/about') }}"
                                    class="nav-link jp-nav-link {{ request()->segment(1) == 'about' ? 'is-active' : '' }}">
                                    About
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/job') }}"
                                    class="nav-link jp-nav-link {{ request()->segment(1) == 'job' ? 'is-active' : '' }}">
                                    Jobs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/blog') }}"
                                    class="nav-link jp-nav-link {{ request()->segment(1) == 'blog' ? 'is-active' : '' }}">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="jp-header-right">
                        <div class="jp-header-support d-none d-xl-flex">
                            <span>Support</span>
                            <strong>support@jobpulse.test</strong>
                        </div>

                        <div class="jp-nav-actions">
                            <div class="user-dropdown" style="display: none">
                                <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="User avatar" />
                                <div class="user-dropdown-content">
                                    <div class="mt-4 text-center">
                                        <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="User avatar" />
                                        <h6 id="userName">User Name</h6>
                                        <hr class="user-dropdown-divider p-0" />
                                    </div>
                                    <a href="{{ url('/dashboard') }}" class="side-bar-item">
                                        <span class="side-bar-item-caption">Dashboard</span>
                                    </a>
                                    <a href="{{ url('/userProfile') }}" class="side-bar-item">
                                        <span class="side-bar-item-caption">Profile</span>
                                    </a>
                                    <div onclick="logout()" class="side-bar-item cursor-pointer">
                                        <span class="side-bar-item-caption">Logout</span>
                                    </div>
                                </div>
                            </div>
                            <div class="login-register jp-auth-cluster">
                                <button type="button" class="btn btn-outline-light login">Login</button>
                                <button type="button" class="btn btn-warning register">Sign-up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="jp-page">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="jp-footer mt-5">
            <div class="container footer-panel">
                <div class="jp-footer-top">
                    <div class="jp-footer-card">
                        <h4 class="jp-footer-brand mb-3">JobPulse</h4>
                        <p class="mb-3">A cleaner hiring workflow for companies and candidates. Browse roles, publish openings, and manage applications from one place.</p>
                        <p class="mb-0">Built for fast recruitment and better visibility across teams, employers, and job seekers.</p>
                        <div class="jp-footer-metrics">
                            <div class="jp-footer-metric">
                                <strong>Fast</strong>
                                <span>Job discovery</span>
                            </div>
                            <div class="jp-footer-metric">
                                <strong>Role-based</strong>
                                <span>Admin control</span>
                            </div>
                            <div class="jp-footer-metric">
                                <strong>Unified</strong>
                                <span>Hiring workflow</span>
                            </div>
                        </div>
                    </div>

                    <div class="jp-footer-card">
                        <h5 class="mb-3">Explore</h5>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/job') }}">Jobs</a></li>
                            <li><a href="{{ url('/blog') }}">Blog</a></li>
                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        </ul>
                    </div>

                    <div class="jp-footer-card">
                        <h5 class="mb-3">Contact & Support</h5>
                        <p class="mb-2">Email: support@jobpulse.test</p>
                        <p class="mb-2">Phone: +880 1521-480800</p>
                        <p class="mb-0">Banani, Dhaka, Bangladesh</p>
                        <div class="jp-footer-note">
                            Hiring teams can manage jobs, employees, blogs, and applications from one modern workspace.
                        </div>
                    </div>
                </div>
                <div class="jp-footer-bottom mt-4">
                    <p class="mb-0">JobPulse dashboard and website share a unified modern UI layer for better consistency and faster navigation.</p>
                </div>
            </div>
        </footer>
    </div>

    <div class="modal animated zoomIn" id="register" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register As</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1 d-flex flex-wrap gap-2">
                                    <a class="btn btn-secondary" href="{{ url('userRegistration?type=candidate') }}">As Candidate</a>
                                    <a class="btn btn-info text-white" href="{{ url('userRegistration?type=company') }}">As Company</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animated zoomIn" id="login" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login As</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1 d-flex flex-wrap gap-2">
                                    <a class="btn btn-danger" href="{{ url('owner/userLogin') }}">As Owner</a>
                                    <a class="btn btn-secondary" href="{{ url('userLogin?type=candidate') }}">As Candidate</a>
                                    <a class="btn btn-info text-white" href="{{ url('userLogin?type=company') }}">As Company</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
        if (getToken()) {
            getUser();
        }

        async function getUser() {
            try {
                showLoader();
                let res = await axios.get("/api/user-profile", HeaderToken());
                hideLoader();
                const userName = document.getElementById('userName');
                const userDropdown = document.querySelector('.user-dropdown');
                const loginRegister = document.querySelector('.login-register');

                userDropdown.style.display = '';
                loginRegister.style.display = 'none';
                userName.innerText = res.data?.full_name;
            } catch (e) {
                unauthorized(e.response.status);
            }
        }

        async function logout() {
            try {
                await axios.get("/api/logout", HeaderToken());
                clearSessionAndStorage();
            } catch (e) {}
        }

        $('.login').on('click', async function() {
            $("#login").modal('show');
        });

        $('.register').on('click', async function() {
            $("#register").modal('show');
        });
    </script>
</body>

</html>
