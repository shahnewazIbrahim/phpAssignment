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

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <header class="bg-gradient-dark py-3">
        <div class="d-flex justify-content-between align-items-center container">
            <a href="{{ url('/') }}"
                class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <span class="fs-4">JobPulse</span>
            </a>
            <div>
                
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 gap-5">
                    <li class="nav-item {{ request()->segment(1) == '' ? 'bg-white rounded-2' : '' }}">
                        <a href="{{ url('/') }}" class="nav-link px-2  {{ request()->segment(1) == '' ? 'text-black' : 'text-white' }}">
                            Home
                        </a>
                    </li>
                    
                    <li class="nav-item {{ request()->segment(1) == 'about' ? ' bg-white rounded-2' : '' }}">
                        <a href="{{ url('/about') }}" class="nav-link px-2  {{ request()->segment(1) == 'about' ? 'text-dark' : 'text-white' }}">
                            About
                        </a>
                    </li>
                    <li class="nav-item {{ request()->segment(1) == 'job' ? ' bg-white rounded-2' : '' }}">
                        <a href="{{ url('/job') }}" class="nav-link px-2  {{ request()->segment(1) == 'job' ? 'text-dark' : 'text-white' }}">
                            Jobs
                        </a>
                    </li>
                    <li class="nav-item {{ request()->segment(1) == 'blog' ? ' bg-white rounded-2' : '' }}">
                        <a href="{{ url('/blog') }}" class="nav-link px-2  {{ request()->segment(1) == 'blog' ? 'text-dark' : 'text-white' }}">
                            Blog
                        </a>
                    </li>
                </ul>
              
            </div>
            
            <div class="">
                <div class="user-dropdown" style="display: none">
                    <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                    <div class="user-dropdown-content ">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                            <h6 id="userName">User Name</h6>
                            <hr class="user-dropdown-divider  p-0"/>
                        </div>
                        <a href="{{url('/dashboard')}}" class="side-bar-item">
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
                <div class="login-register">
                    <button type="button" class="btn btn-outline-light me-2 login"
                        href="{{ url('userLogin') }}">Login</button>
                    <button type="button" class="btn btn-warning register">Sign-up</button>
                    
                </div>
            </div>
        </div>
    </header>

    <div style="min-height:100vh">
        @yield('content')
    </div>

    <footer class="footer py-4 bg-gradient-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white">Job Pulse</h5>
                    <p class="text-white">A place you find your way</p>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white">Link</h5>
                    <ul class="list-unstyled text-white">
                        <li class="nav-item"><a href="{{ url('/') }}" class="text-white text-decoration-none hover">Home</a></li>
                        <li><a href="{{ url('/about') }}" class="text-white text-decoration-none">About</a></li>
                        <li><a href="{{ url('/job') }}" class="text-white text-decoration-none">Job</a></li>
                        <li><a href="{{ url('/blog') }}" class="text-white text-decoration-none">Blog</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-white text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 text-white">
                    <h5 class="text-white">Contact</h5>
                    <p>Contact Info:<br> Email: example@example.com<br> Phone: +01521480800</p>
                </div>
            </div>
        </div>
    </footer>

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
                                <div class="col-12 p-1">
                                    <a class="btn btn-outline-light me-2 bg-secondary"
                                        href="{{ url('userRegistration?type=candidate') }}"> As Candidate</a>
                                    <a class="btn btn-outline-light me-2 bg-info"
                                        href="{{ url('userRegistration?type=company') }}"> As Company</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Login as</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <a class="btn btn-outline-light me-2 bg-danger"
                                        href="{{ url('owner/userLogin') }}"> As Owner</a>
                                    <a class="btn btn-outline-light me-2 bg-secondary"
                                        href="{{ url('userLogin?type=candidate') }}"> As Candidate</a>
                                    <a class="btn btn-outline-light me-2 bg-info"
                                        href="{{ url('userLogin?type=company') }}"> As Company</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script></script>

    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
        if (getToken()) {
            getUser();
        }   
    
        async function getUser() {
            // console.log(getToken());
        
            try {
                showLoader();
                let res=await axios.get("/api/user-profile",HeaderToken());
                hideLoader();
                const userName= document.getElementById('userName')
                const userDropdown= document.querySelector('.user-dropdown')
                const loginRegister= document.querySelector('.login-register')

                userDropdown.style.display = '';
                loginRegister.style.display = 'none';

                userName.innerText = res.data?.full_name;
                
            }catch (e) {
                unauthorized(e.response.status)
            }
            
        }
        async function logout() {
            try {
                await axios.get("/api/logout",HeaderToken());
                clearSessionAndStorage()
            }
            catch(e) {

            }
        }

        $('.login').on('click', async function() {
            $("#login").modal('show');
        })
        $('.register').on('click', async function() {
            $("#register").modal('show');
        })
    </script>
</body>

</html>
