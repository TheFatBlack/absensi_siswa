<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="ti-menu"></i>
                    </a>
                    <a class="mobile-search morphsearch-search" href="#">
                        <i class="ti-search"></i>
                    </a>
                    <a href="index.html">
                        <img class="img-fluid" src="{{asset('assets/images/logo.png')}}" alt="Theme-Logo" />
                    </a>
                    <a class="mobile-options">
                        <i class="ti-more"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li>
                            <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                        </li>

                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="ti-fullscreen"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="user-profile header-notification">
                            <a href="#!">
                                <img src="{{asset('assets/images/users.png')}}" class="img-radius"
                                    alt="Users-Profile-Image">
                                {{ Auth::user()->username }} | {{ Auth::user()->level }}
                                <i class="ti-angle-down"></i>
                            </a>
                            <ul class="show-notification profile-notification">
                                <form action="">
                                    <li>
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <i class="ti-settings"></i>
                                            <span>Settings</span>
                                        </button>
                                    </li>
                                </form>
                                <form action="">
                                    <li>
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <i class="ti-user"></i>
                                            <span>Profile</span>
                                        </button>
                                    </li>
                                </form>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <li>
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <i class="ti-layout-sidebar-left"></i>
                                            <span>Logout</span>
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>