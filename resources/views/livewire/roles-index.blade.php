<div class="content">
    <div class="@if($view_type == 'grid') grid @endif grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap  items-center">
            <h2 class="text-lg font-medium mr-auto">Roles</h2>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="relative text-slate-500">
                    <select class="w-20 form-select box mt-3 sm:mt-0 d-mr-5 xs-w-100" wire:model="view_type" wire:change="changeViewType">
                        <option value="grid">Grid</option>
                        <option value="table">Table</option>
                    </select>
                    <select class="w-20 form-select box mt-3 sm:mt-0 d-mr-5 xs-w-100" wire:model="show" wire:change="changeShow">
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="36">36</option>
                    </select>
                </div>
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0 xs-w-100">
                <div class="w-56 relative text-slate-500 mr-5 xs-w-100">
                    <input type="text" class="form-control w-56 box pr-10 xs-w-100" placeholder="Search..." wire:model.debounce.500ms="search_term"
                           wire:keydown.debounce.500ms="resetPage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search"
                         class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
            </div>
            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_create'))
                <a href="{{ route('roles.create') }}" class="btn btn-primary shadow-md xs-mt-4 xs-w-100">Add New Role</a>
            @endif
        </div>

        @if($view_type == 'grid')
            @foreach($roles as $role)
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-3" wire:loading.remove>
                    <div class="box">
                        <div class="flex items-start px-5 pt-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="javascript:void(0);" class="font-medium">{{ $role->name }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left p-5" wire:ignore.self>
                            <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     icon-name="award" data-lucide="award" class="lucide lucide-award w-3 h-3 mr-2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                                {{ $role->permissionRoles->count() }} Permissions
                            </div>
                        </div>
                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_show'))
                            <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                <div class="flex items-center justify-center text-primary">
                                    <a class="flex items-center ml-5 text-primary" href="{{ route('roles.show', ['role' => $role->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="search" data-lucide="search" class="lucide lucide-search w-4 h-4 mr-1">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
               <table class="table table-report py-4" wire:loading.remove>
                <thead>
                <tr>
                    <th class="whitespace-nowrap"></th>
                    <th class="whitespace-nowrap">NAME</th>
                    <th class="whitespace-nowrap">PERMISSIONS</th>
                    @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_show'))
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr class="cursor-pointer">
                        <td class="w-20">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="rounded-full ml-1" width="20">
                        </td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissionRoles->count() }} Permissions</td>
                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_show'))
                            <td class="table-report__action w-40">
                                <div class="flex justify-center items-center text-primary">
                                    <a class="flex items-center mr-3" href="{{ route('roles.show', ['role' => $role->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="search" data-lucide="search" class="lucide lucide-search w-4 h-4 mr-1">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        @endif

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center" wire:loading.remove>
            <div class="hidden md:block mr-auto text-slate-500">
                @if($roles->total() > 0)
                    Showing {{ $roles->count() * ($roles->currentPage() - 1) + 1 }}-{{ $roles->count() }} of {{ $roles->total() }} entries
                @else
                    Showing 0-0 of {{ $roles->total() }} entries
                @endif
            </div>

            {{ $roles->links('layouts.custom-pagination') }}

        </div>

        <div wire:loading>
            <div class="text-center">
                <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
                <lord-icon
                        src="https://cdn.lordicon.com/msoeawqm.json"
                        trigger="loop"
                        delay="150"
                        colors="primary:#0c5240,secondary:#0c5240"
                        stroke="50"
                        style="width:100px;height:100px;text-align: center">
                </lord-icon>
                <p class="ms-2 text-center d-inline">Searching...</p>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.addEventListener('reloadDataTable', (e) => {
            loadDataTable();
        });
    </script>
@endsection
