<nav class="side-nav">
    <ul>
        <li>
            <a href="{{ route('dashboard.index') }}" class="side-menu @if(Request::is('/')) side-menu--active @endif">
                <div class="side-menu__icon"><i data-lucide="home"></i></div>
                <div class="side-menu__title"> Dashboard</div>
            </a>
        </li>

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_projects_index'))
            <li>
                <a href="{{ route('projects.index') }}"
                   class="side-menu @if(Request::is('projects') || Request::is('projects/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="folder"></i></div>
                    <div class="side-menu__title"> Projects</div>
                </a>
            </li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_index'))
            <li>
                <a href="{{ route('tickets.index') }}"
                   class="side-menu @if(Request::is('tickets') || Request::is('tickets/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="file-text"></i></div>
                    <div class="side-menu__title"> Tickets</div>
                </a>
            </li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_index'))
            <li>
                <a href="{{ route('announcements.index') }}"
                   class="side-menu @if(Request::is('announcements') || Request::is('announcements/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="megaphone"></i></div>
                    <div class="side-menu__title"> Announcements</div>
                </a>
            </li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_users_index'))
            <li>
                <a href="{{ route('users.index') }}"
                   class="side-menu @if(Request::is('users') || Request::is('users/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="users"></i></div>
                    <div class="side-menu__title"> Users</div>
                </a>
            </li>
        @endif



        @if(\App\Classes\PermissionChecker::instance()->hasPermission(['manage_categories_index', 'manage_statuses_index', 'manage_priorities_index', 'manage_roles_index']))
            <li class="side-nav__devider my-6"></li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_categories_index'))
            <li>
                <a href="{{ route('categories.index') }}"
                   class="side-menu @if(Request::is('categories') || Request::is('categories/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="list-checks"></i></div>
                    <div class="side-menu__title"> Categories</div>
                </a>
            </li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_index'))
            <li>
                <a href="{{ route('statuses.index') }}"
                   class="side-menu @if(Request::is('statuses') || Request::is('statuses/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="activity"></i></div>
                    <div class="side-menu__title"> Statuses</div>
                </a>
            </li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_priorities_index'))
            <li>
                <a href="{{ route('priorities.index') }}"
                   class="side-menu @if(Request::is('priorities') || Request::is('priorities/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="lightbulb"></i></div>
                    <div class="side-menu__title"> Priorities</div>
                </a>
            </li>
        @endif

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_index'))
            <li>
                <a href="{{ route('roles.index') }}"
                   class="side-menu @if(Request::is('roles') || Request::is('roles/*')) side-menu--active @endif">
                    <div class="side-menu__icon"><i data-lucide="award"></i></div>
                    <div class="side-menu__title"> Roles</div>
                </a>
            </li>
        @endif
    </ul>
</nav>
