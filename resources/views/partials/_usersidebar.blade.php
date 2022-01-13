<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li>
                    <a href="{{ route('home') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-rocket"></i> <span> Tasks</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('tasks.active') }}">Active Tasks</a></li>
                        <li><a href="{{ route('tasks.finished') }}">Submitted Tasks</a></li>
                        <li><a href="{{ route('user.overdue') }}">Overdue Tasks</a></li>
                        @if (Auth::user()->role_id == 2)
                        <li><a href="{{ route('tasks.sector') }}">Sector's Active Tasks</a></li>
                        <li><a href="{{ route('tasks.sector.completed') }}">Sector's Completed Tasks</a></li>
                        <li><a href="{{ route('sector.overdue') }}">Sector's Overdue Tasks</a></li>
                        @endif
                    </ul>
                </li>
                {{-- <li>
                    <a href="{{ route('user.activities') }}"><i class="la la-bell"></i> <span>Activities</span></a>
                </li> --}}
                <li>
                    <a href="{{ route('user.settings') }}"><i class="la la-cog"></i> <span>Settings</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
