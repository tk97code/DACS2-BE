<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src={{asset("assets/images/faces/face1.jpg")}} alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
                    <span class="text-secondary text-small">{{Auth::user()->permission->permission_name}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{route('dashboard.index')}}>
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{route('class.index')}}>
                <span class="menu-title">Class</span>
                <i class="mdi mdi-google-classroom menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{route('dashboard.exam')}}>
                <span class="menu-title">Exam</span>
                <i class="mdi mdi-note-text-outline menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>