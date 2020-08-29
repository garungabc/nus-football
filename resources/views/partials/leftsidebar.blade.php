<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Dashboards</li>
    <li>
        <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'mm-active' : '' }}">
            <i class="metismenu-icon pe-7s-rocket"></i>
            Dashboard
        </a>
    </li>
    <li class="app-sidebar__heading">
        NUS Football
    </li>
    <li>
    <a href="{{ route('prepare.team') }}" class="{{ Request::is('team/*') ? 'mm-active' : '' }}">
            <i class="metismenu-icon pe-7s-display2"></i>
            Organize Team
        </a>
    </li>
    <li>
        <a href="{{ route('history.index') }}" class="{{ Request::is('history*') ? 'mm-active' : '' }}">
            <i class="metismenu-icon pe-7s-display2"></i>
            History
        </a>
    </li>
    <li >
        <a href="#" class="{{ Request::is('users*') ? 'mm-active' : '' }}">
            <i class="metismenu-icon pe-7s-diamond"></i>
            Users
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul class="{{ Request::is('users*') ? 'mm-show' : '' }}">
            <li>
                <a href="{{ route('user.index') }}" class="{{ Request::is('users') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon"></i>
                    List
                </a>
            </li>
            <li>
                <a href="{{ route('user.create') }}" class="{{ Request::is('users/create') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon"> </i>Add new
                </a>
            </li>
        </ul>
    </li>
</ul>
