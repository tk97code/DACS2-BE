@if (strtolower(Auth::user()->permission->permission_name) === 'teacher') 
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src={{Auth::user()->avatar}} alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
                    <span class="text-secondary text-small">{{Auth::user()->permission->permission_name}}</span>
                </div>
                <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> -->
            </a>
        </li>
        <li class="nav-item {{request()->is('teacher/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href={{route('teacher.dashboard.index')}} >
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{request()->is('teacher/dashboard/class*') ? 'active' : '' }}">
            <a class="nav-link " href={{route('teacher.dashboard.class.index')}} >
                <span class="menu-title">Class</span>
                <i class="mdi mdi-google-classroom menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{request()->is('teacher/dashboard/test*') ? 'active' : '' }}">
            <a class="nav-link " href={{route('teacher.dashboard.test.index')}} >
                <span class="menu-title">Test</span>
                <i class="mdi mdi-note-text-outline menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
@else
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{Auth::user()->avatar}}" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
                    <span class="text-secondary text-small">{{Auth::user()->permission->permission_name}}</span>
                </div>
                <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> -->
            </a>
        </li>
        <li class="nav-item {{request()->is('student/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href={{route('student.dashboard.index')}}>
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item {{request()->is('student/dashboard/class*') ? 'active' : '' }}">
            <a class="nav-link" href={{route('student.dashboard.class.index')}}>
                <span class="menu-title">Class</span>
                <i class="mdi mdi-google-classroom menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
@endif