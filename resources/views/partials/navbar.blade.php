@guest
    {{-- <div class="container">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container">
                    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-gradient text-primary" href="../pages/dashboard.html">
                        Rental Property
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                    href="../pages/dashboard.html">
                                    <i class="fa fa-chart-pie opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="../pages/profile.html">
                                    <i class="fa fa-user opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    About
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="../pages/sign-up.html">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Sign Up
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-2" href="../pages/sign-in.html">
                                    <i class="fas fa-key opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Sign In
                                </a>
                            </li>
                        </ul>
                        <li class="nav-item d-flex align-items-center">
                            <a class="btn btn-round btn-sm mb-0 btn-outline-primary me-2" target="_blank"
                                href="https://www.creative-tim.com/builder?ref=navbar-soft-dashboard">Online Builder</a>
                        </li>
                        <ul class="navbar-nav d-lg-block d-none">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/product/soft-ui-dashboard"
                                    class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Free download</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>
</div> --}}

    <!-- Navbar Light -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white z-index-3 py-3">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-gradient text-primary" href="" rel="tooltip"
                title="Online Rental Property" data-placement="bottom" target="_blank">
                Rental Property
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto">
                    <div class="row">
                        <div class="col-auto m-auto">
                            <a href="{{ url('/') }}" class="cursor-pointer">
                                <i class="fa-solid fa-house" style="color: #8591a4;"></i>
                                Home
                            </a>
                        </div>
                        <div class="col-auto m-auto">
                            <div class="dropdown">
                                <a class="cursor-pointer" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1" aria-hidden="true"></i>
                                    Sign Up
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right px-2 py-3 ms-n4"
                                    aria-labelledby="dropdownMenuButton">
                                    <li><a data-bs-toggle='modal' data-bs-target='#myLModal' class="dropdown-item">
                                            <i class="fa-solid fa-building-user" style="color: #8591a4;"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; As Landlord</span></a>
                                    </li>
                                    <li><a data-bs-toggle='modal' data-bs-target='#myTModal' class="dropdown-item">
                                            <i class="fa-solid fa-circle-user" style="color: #8591a4;"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; As Tenant</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-auto m-auto">
                            <a class="cursor-pointer" data-bs-toggle='modal' data-bs-target='#signinModal'>
                                <i class="fas fa-key opacity-6 text-dark me-1" aria-hidden="true"></i>
                                Sign In
                            </a>
                        </div>
                        <div class="col-auto">
                            {{-- <div class="bg-white border-radius-lg d-flex me-2">
                                <input type="text" class="form-control border-0 ps-3" placeholder="Type here...">
                                <button class="btn bg-gradient-primary my-1 me-1">Search</button>
                            </div> --}}
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
@elseif(Auth::user()->role == 'tenant')
    <!-- Navbar Light -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white z-index-3 py-3">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-gradient text-primary" href="" rel="tooltip"
                title="Online Rental Property" data-placement="bottom" target="_blank">
                Rental Property
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav navbar-nav-hover ms-auto">
                    <div class="row">
                        <div class="col-auto m-auto">
                            <a href="{{ url('/') }}" class="cursor-pointer">
                                <i class="fa-solid fa-house" style="color: #8591a4;"></i>
                                Home
                            </a>
                        </div>
                        <div class="col-auto m-auto">
                            <div class="dropdown">
                                <a class="cursor-pointer" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="d-sm-inline d-none">
                                        <img src="{{ asset(Auth::user()->tenants->imagePath) }}" alt="avatar"
                                            class="rounded-circle img-fluid" style="width: 25px;">
                                    </span> &nbsp; {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right px-2 py-3 ms-n4"
                                    aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('tenant.profile') }}">
                                            <i class="fa-solid fa-building-user" style="color: #8591a4;"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; Profile</span></a>
                                    </li>
                                    <li><a href="{{ route('con', Auth::user()->id) }}" class="dropdown-item">
                                            <i class="fa fa-comments"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; Conversation</span></a>
                                    </li>
                                    <li><a href="{{ route('user.logout') }}" class="dropdown-item">
                                            <i class="fa-solid fa-person-running"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; Logout</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="col-auto m-auto">
                            <a class="cursor-pointer" data-bs-toggle='modal' data-bs-target='#signinModal'>
                                <i class="fas fa-key opacity-6 text-dark me-1" aria-hidden="true"></i>
                                Sign In
                            </a>
                        </div> --}}
                        <div class="col-auto">
                            {{-- <div class="bg-white border-radius-lg d-flex me-2">
                                <input type="text" class="form-control border-0 ps-3" placeholder="Type here...">
                                <button class="btn bg-gradient-primary my-1 me-1">Search</button>
                            </div> --}}
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
@else
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav> --}}
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    {{-- <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div> --}}
                </div>

                <ul class="navbar-nav  justify-content-end">
                    {{-- <li class="nav-item d-flex align-items-center">
            <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard">Online Builder</a>
          </li> --}}
                    @if (Auth::check())
                        @if (Auth::user()->role == 'tenant' or Auth::user()->role == 'landlord' or Auth::user()->role == 'admin')
                            <li class="nav-item d-flex align-items-center pe-md-3 d-flex align-items-center">
                                {{-- <a href="{{ route('user.logout') }}" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa-solid fa-person-running"></i>
                                <span class="d-sm-inline d-none">Logout</span>
                            </a> --}}
                            </li>

                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-sm-inline d-none">
                                        @if (Auth::user()->role === 'tenant')
                                            <img src="{{ asset(Auth::user()->tenants->imagePath) }}" alt="avatar"
                                                class="rounded-circle img-fluid" style="width: 25px;">
                                        @elseif (Auth::user()->role === 'landlord')
                                            <img src="{{ asset(Auth::user()->landlords->imagePath) }}" alt="avatar"
                                                class="rounded-circle img-fluid" style="width: 25px;">
                                        @elseif (Auth::user()->role === 'admin')
                                            <img src="{{ asset(Auth::user()->admins->imagePath) }}" alt="avatar"
                                                class="rounded-circle img-fluid" style="width: 25px;">
                                        @else
                                        @endif
                                    </span> &nbsp; {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    {{-- <li><a class="dropdown-item" href="javascript:;">Landlord</a></li> --}}
                                    <li>
                                        @if (Auth::user()->role === 'tenant')
                                            <a href="{{ route('tenant.profile') }}" class="dropdown-item">
                                            @elseif (Auth::user()->role === 'landlord')
                                                <a href="{{ route('landlord.profile') }}" class="dropdown-item">
                                                @else
                                                    <a href="" class="dropdown-item">
                                        @endif
                                        <i class="fa-solid fa-circle-user"></i>
                                        <span class="d-sm-inline d-none"> &nbsp; Profile</span></a>
                                    </li>
                                    <li><a href="{{ route('con', Auth::user()->id) }}" class="dropdown-item">
                                            <i class="fa fa-comments"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; Conversation</span></a>
                                    </li>
                                    <li><a href="{{ route('user.logout') }}" class="dropdown-item">
                                            <i class="fa-solid fa-person-running"></i>
                                            <span class="d-sm-inline d-none"> &nbsp; Logout</span></a>
                                    </li>
                                    {{-- <li><a class="dropdown-item" href="javascript:;">Something else here</a></li> --}}
                                </ul>
                            </li>
                        @endif
                    @else
                        <li class="nav-item d-flex align-items-center pe-md-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0"
                                data-bs-toggle='modal' data-bs-target='#signinModal'>
                                <span class="d-sm-inline d-none">
                                    <i class="fa-solid fa-right-to-bracket"></i> Sign In
                                </span>
                            </a>
                        </li>

                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>

                        {{-- <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0">
              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
          </li> --}}
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user-plus"></i>
                                <span class="d-sm-inline d-none">Register As</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" data-bs-toggle='modal'
                                        data-bs-target='#myTModal'><i class="fa-solid fa-user"></i> &nbsp; Tenant</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle='modal'
                                        data-bs-target='#myLModal'><i class="fa-solid fa-people-roof"></i> &nbsp;
                                        Landlord</a></li>
                                {{-- <li><a class="dropdown-item" href="javascript:;">Something else here</a></li> --}}
                            </ul>
                        </li>
                    @endif



                </ul>

            </div>
        </div>
    </nav>
    <!-- End Navbar -->

@endguest
