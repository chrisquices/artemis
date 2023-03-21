<div class="content">
    <div class="@if($view_type == 'grid') grid @endif grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap  items-center">
            <h2 class="text-lg font-medium mr-auto">Statuses</h2>
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
            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_create'))
                <a href="{{ route('statuses.create') }}" class="btn btn-primary shadow-md xs-mt-4 xs-w-100">Add New Status</a>
            @endif
        </div>

        @if($view_type == 'grid')
            @foreach($statuses as $status)
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-3" wire:loading.remove>
                    <div class="box">
                        <div class="flex items-start px-5 pt-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="javascript:void(0);"
                                       class="font-medium">{{ $status->name }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left p-5">
                            <div class="flex items-center justify-center lg:justify-start text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="mail"
                                     data-lucide="layout-list" class="lucide lucide-mail w-3 h-3 mr-2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                {{ $status->type }}
                            </div>
                            <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1"
                                 style="color: {{ $status->color }};">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="mail"
                                     data-lucide="palette" class="lucide lucide-mail w-3 h-3 mr-2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                {{ $status->color }}
                            </div>
                        </div>
                        <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                            @if($status->is_active)
                                <div class="flex items-center justify-center text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="activity" data-lucide="activity"
                                         class="lucide lucide-activity w-4 h-4 mr-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                    </svg>
                                    Active

                                    @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_show'))
                                        <a class="flex items-center ml-5 text-primary"
                                           href="{{ route('statuses.show', ['status' => $status->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="activity" data-lucide="search"
                                                 class="lucide lucide-activity w-4 h-4 mr-1">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                            View
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="flex items-center justify-center text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="activity" data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                    </svg>
                                    Inactive

                                    @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_show'))
                                        <a class="flex items-center ml-5 text-primary"
                                           href="{{ route('statuses.show', ['status' => $status->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="search" data-lucide="search" class="lucide lucide-activity w-4 h-4 mr-1">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                            View
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
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
                        <th class="whitespace-nowrap">TYPE</th>
                        <th class="whitespace-nowrap">COLOR</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_show'))
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statuses as $status)
                        <tr class="cursor-pointer">
                            <td class="w-20">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="rounded-full ml-1" width="20">
                            </td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->type }}</td>
                            <td style="color: {{ $status->color }};">{{ $status->color }}</td>
                            <td class="table-report__action w-40">
                                @if($status->is_active)
                                    <div class="flex items-center justify-center text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="activity" data-lucide="activity"
                                             class="lucide lucide-activity w-4 h-4 mr-2">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg>
                                        Active
                                    </div>
                                @else
                                    <div class="flex items-center justify-center text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="activity" data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg>
                                        Inactive
                                    </div>
                                @endif
                            </td>
                            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_statuses_show'))
                                <td class="table-report__action w-40">
                                    <div class="flex justify-center items-center text-primary">
                                        <a class="flex items-center mr-3" href="{{ route('statuses.show', ['status' => $status->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="search" data-lucide="search" class="lucide lucide-activity w-4 h-4 mr-1">
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
                @if($statuses->total() > 0)
                    Showing {{ $statuses->count() * ($statuses->currentPage() - 1) + 1 }}-{{ $statuses->count() }}
                    of {{ $statuses->total() }} entries
                @else
                    Showing 0-0 of {{ $statuses->total() }} entries
                @endif
            </div>

            {{ $statuses->links('layouts.custom-pagination') }}

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
