<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a href="{{ route('home') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                </li>
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('employees.all') }}">All Employees</a></li>
                        {{-- <li><a href="attendance.html">Attendance (Admin)</a></li> --}}
                        <li><a href="{{ route('departments') }}">Departments</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-rocket"></i> <span> Tasks</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('tasks.index') }}">Active Tasks</a></li>
                        <li><a href="{{ route('tasks.taskboard') }}">Submitted Tasks</a></li>
                        <li><a href="{{ route('tasks.overdue') }}">Overdue Tasks</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/activities"><i class="la la-bell"></i> <span>Activities</span></a>
                </li>
                <li>
                    <a href="settings.html"><i class="la la-cog"></i> <span>Settings</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
