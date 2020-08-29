<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Dashboards</li>
    <li>
        <a href="{{ route('dashboard') }}" class="mm-active">
            <i class="metismenu-icon pe-7s-rocket"></i>
            Dashboard
        </a>
    </li>
    <li class="app-sidebar__heading">
        NUS Football
    </li>
    <li>
        <a href="{{ route('prepare.team') }}">
            <i class="metismenu-icon pe-7s-display2"></i>
            Organize Team
        </a>
    </li>
    <li>
        <a href="{{ route('history.index') }}">
            <i class="metismenu-icon pe-7s-display2"></i>
            History
        </a>
    </li>
    <li>
        <a href="#">
            <i class="metismenu-icon pe-7s-diamond"></i>
            Users
            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
        </a>
        <ul>
            <li>
                <a href="{{ route('user.index') }}">
                    <i class="metismenu-icon"></i>
                    List
                </a>
            </li>
            <li>
                <a href="{{ route('user.create') }}">
                    <i class="metismenu-icon"> </i>Add new
                </a>
            </li>
        </ul>
    </li>
</ul>
