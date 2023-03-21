<div class="content">
    <div class="@if($view_type == 'grid') grid @endif grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
            <h2 class="text-lg font-medium mr-auto">Announcements</h2>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="relative text-slate-500">
                    <select class="w-20 form-select box mt-3 sm:mt-0 d-mr-5 xs-w-100" wire:model="view_type" wire:change="changeViewType">
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
            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_create'))
                <a href="{{ route('announcements.create') }}" class="btn btn-primary shadow-md xs-mt-4 xs-w-100">Add New Announcement</a>
            @endif
        </div>

        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report py-4" wire:loading.remove>
                <thead>
                <tr>
                    <th class="whitespace-nowrap"></th>
                    <th class="whitespace-nowrap">TITLE</th>
                    <th class="whitespace-nowrap">SUBMITTED BY</th>
                    <th class="whitespace-nowrap">SUBMITTED AT</th>
                    <th class="text-center whitespace-nowrap">STATUS</th>
                    @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_show'))
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($announcements as $announcement)
                    <tr class="cursor-pointer">
                        <td class="w-20">
                            <img src="{{ $announcement->user->photo_url }}" alt="Logo" class="rounded-full ml-1" width="20">
                        </td>
                        <td>{{ $announcement->title }}</td>
                        <td class="w-40">{{ $announcement->user->name }}</td>
                        <td class="w-40">{{ $announcement->submitted_at->diffForHumans() }}</td>
                        <td class="table-report__action w-40">
                            @if($announcement->is_active)
                                <div class="flex items-center justify-center text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="activity" data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
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
                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_show'))
                            <td class="table-report__action w-40">
                                <div class="flex justify-center items-center text-primary">
                                    <a class="flex items-center mr-3"
                                       href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}">
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

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center" wire:loading.remove>
            <div class="hidden md:block mr-auto text-slate-500">
                @if($announcements->total() > 0)
                    Showing {{ $announcements->count() * ($announcements->currentPage() - 1) + 1 }}-{{ $announcements->count() }}
                    of {{ $announcements->total() }} entries
                @else
                    Showing 0-0 of {{ $announcements->total() }} entries
                @endif
            </div>

            {{ $announcements->links('layouts.custom-pagination') }}

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
