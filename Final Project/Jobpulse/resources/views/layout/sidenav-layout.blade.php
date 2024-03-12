<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title></title>

    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.ico')}}" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/toastify.min.css')}}" rel="stylesheet" />


    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css')}}" rel="stylesheet" />

    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>


    <script src="{{asset('js/toastify-js.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>




</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="{{ url('/userProfile') }}">
            <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2"  src="{{asset('images/menu.svg')}}" alt="logo"/>
            </span>
            <div class="fs-5 text-primary font-weight-bold">
                JobPulse
            </div>
        </a>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('images/user.webp')}}" alt=""/>
                        <h6 id="userName">User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
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

<div id="sideNavRef" class="side-nav-open">

    <a href="{{url("/dashboard")}}" class="side-bar-item {{ request()->segment(1) == 'dashboradPage' ? 'side-bar-item-active' : '' }}">
        <i class="bi bi-graph-up"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>

    <a href="{{url("users")}}"  id="userOption" class="side-bar-item {{ request()->segment(1) == 'users' ? 'side-bar-item-active' : '' }}"  style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">User</span>
    </a>

    <a href="{{url("/admin/role")}}" id="rolesOption" class="side-bar-item {{ request()->segment(2) == 'role' ? 'side-bar-item-active' : '' }}"  style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Roles</span>
    </a>

    <a href="{{url("/admin/employee")}}" id="employesOption" class="side-bar-item {{ request()->segment(2) == 'employee' ? 'side-bar-item-active' : '' }}"  style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Employees</span>
    </a>

    <a href="{{url("/admin/job")}}" id="jobsOption" class="side-bar-item {{ request()->segment(2) == 'job' ? 'side-bar-item-active' : '' }}" style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Jobs</span>
    </a>

    <a href="{{url("/admin/applied-job")}}" id="appliedJobsOption" class="side-bar-item {{ request()->segment(2) == 'applied-job' ? 'side-bar-item-active' : '' }}">
        <i class="bi bi-people" style="display:none"></i>
        <span class="side-bar-item-caption">Applied Jobs</span>
    </a>

    <a href="{{url("/admin/candidate-profile")}}" id="candidateProfileOption" class="side-bar-item {{ request()->segment(2) == 'candidate-profile' ? 'side-bar-item-active' : '' }}">
        <i class="bi bi-people" style="display:none"></i>
        <span class="side-bar-item-caption">Candidate Profile</span>
    </a>

    <a href="{{url("/admin/about")}}" id="aboutOption" class="side-bar-item {{ request()->segment(2) == 'about' ? 'side-bar-item-active' : '' }}"  style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">About</span>
    </a>

    <a href="{{url("/admin/blog")}}" id="blogOption" class="side-bar-item {{ request()->segment(2) == 'blog' ? 'side-bar-item-active' : '' }}"  style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Blog</span>
    </a>

    <a href="{{url("/admin/plugin")}}" id="pluginOption" class="side-bar-item {{ request()->segment(2) == 'plugin' ? 'side-bar-item-active' : '' }}"  style="display:none">
        <i class="bi bi-people"></i>
        <span class="side-bar-item-caption">Plugin</span>
    </a>
        
    


</div>


<div id="contentRef" class="content">
    @yield('content')
</div>



<script>

    getUser();

    async function getUser() {

    try {
        showLoader();
        let res=await axios.get("/api/user-profile",HeaderToken());
        hideLoader();
        menuHandler(res.data.assignedRole)
        const userName= document.getElementById('userName')
        userName.innerText = res.data?.firstName;
        
    }catch (e) {
        unauthorized(e.response.status)
    }
    
}

function menuHandler(roles) {
    console.log(!(roles.includes('Owner') || (roles.includes('Company'))), roles);
    if ((roles.includes('Owner') || (roles.includes('Company')))) {
        // console.log(roles);
        document.getElementById('rolesOption').style.display= 'block'
        document.getElementById('employesOption').style.display= 'block'
        document.getElementById('pluginOption').style.display= 'block'
        document.getElementById('jobsOption').style.display= 'block'
    }
    if ((roles.includes('Owner'))) {
        document.getElementById('userOption').style.display= 'block'
        document.getElementById('aboutOption').style.display= 'block'
        document.getElementById('blogOption').style.display= 'block'
    }

    if ((roles.includes('Candidaet'))) {
        document.getElementById('appliedJobsOption').style.display= 'block'
        document.getElementById('candidateProfileOption').style.display= 'block'
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
</script>

</body>
</html>
