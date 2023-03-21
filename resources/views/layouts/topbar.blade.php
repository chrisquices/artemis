<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Artemis Logo" class="w-6" src="{{ asset('assets/images/logo.svg') }}">
        </a>
        <a href="javascript:;" class="mobile-menu-toggler">
            <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
        <ul class="scrollable__content py-2"s>
            <li>
                <a href="{{ route('dashboard.index') }}" class="menu mb-2 @if(Request::is('/')) menu--active @endif">
                    <div class="menu__icon">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Artemis Logo" width="29">
                    </div>
                    <div class="menu__title"> Menu</div>
                </a>
            </li>

            <hr class="mb-3">

            <li>
                <a href="{{ route('dashboard.index') }}" class="menu @if(Request::is('/')) menu--active @endif">
                    <div class="menu__icon"><i data-lucide="home"></i></div>
                    <div class="menu__title"> Dashboard</div>
                </a>
            </li>

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_projects_index'))
                <li>
                    <a href="{{ route('projects.index') }}"
                       class="menu @if(Request::is('projects') || Request::is('projects/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="folder"></i></div>
                        <div class="menu__title"> Projects</div>
                    </a>
                </li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_index'))
                <li>
                    <a href="{{ route('tickets.index') }}"
                       class="menu @if(Request::is('tickets') || Request::is('tickets/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="file-text"></i></div>
                        <div class="menu__title"> Tickets</div>
                    </a>
                </li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_index'))
                <li>
                    <a href="{{ route('announcements.index') }}"
                       class="menu @if(Request::is('announcements') || Request::is('announcements/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="megaphone"></i></div>
                        <div class="menu__title"> Announcements</div>
                    </a>
                </li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_users_index'))
                <li>
                    <a href="{{ route('users.index') }}"
                       class="menu @if(Request::is('users') || Request::is('users/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="users"></i></div>
                        <div class="menu__title"> Users</div>
                    </a>
                </li>
            @endif



            @if(\App\Classes\PermissionChecker::instance()->hasPermission(['manage_categories_index', 'manage_statuses_index', 'manage_priorities_index', 'manage_roles_index']))
                <li class="nav__devider my-6"></li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_categories_index'))
                <li>
                    <a href="{{ route('categories.index') }}"
                       class="menu @if(Request::is('categories') || Request::is('categories/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="list-checks"></i></div>
                        <div class="menu__title"> Categories</div>
                    </a>
                </li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_index'))
                <li>
                    <a href="{{ route('statuses.index') }}"
                       class="menu @if(Request::is('statuses') || Request::is('statuses/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="activity"></i></div>
                        <div class="menu__title"> Statuses</div>
                    </a>
                </li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_priorities_index'))
                <li>
                    <a href="{{ route('priorities.index') }}"
                       class="menu @if(Request::is('priorities') || Request::is('priorities/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="lightbulb"></i></div>
                        <div class="menu__title"> Priorities</div>
                    </a>
                </li>
            @endif

            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_index'))
                <li>
                    <a href="{{ route('roles.index') }}"
                       class="menu @if(Request::is('roles') || Request::is('roles/*')) menu--active @endif">
                        <div class="menu__icon"><i data-lucide="award"></i></div>
                        <div class="menu__title"> Roles</div>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

<div class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] mt-12 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
    <div class="h-full flex items-center">
        <a href="" class="-intro-x hidden md:flex">
            <img alt="Artemis Logo" class="w-6" src="{{ asset('assets/images/logo.svg') }}">
            <span class="text-white text-lg ml-3"> Artemis </span>
        </a>

        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item"><a href="#">Artemis</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>

        <livewire:global-search-bar/>

        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_index'))
            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_show'))
                <livewire:global-announcements-icon/>
            @endif
        @endif

        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button"
                 aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="Profile Picture" src="{{ auth()->user()->photo_url }}">
            </div>
            <div class="dropdown-menu w-56">
                <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">{{ auth()->user()->email }}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="#" class="dropdown-item hover:bg-white/5" onclick="$('#form-logout').submit();">
                            <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('logout') }}" method="POST" id="form-logout">@csrf</form>
