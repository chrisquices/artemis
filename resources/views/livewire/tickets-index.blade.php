<div class="content">
    <div class="@if($view_type == 'grid') grid @endif grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap  items-center">
            <h2 class="text-lg font-medium mr-auto">Tickets</h2>
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
            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_create'))
                <a href="{{ route('tickets.create') }}" class="btn btn-primary shadow-md xs-mt-4 xs-w-100">Add New Ticket</a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="col-span-12 lg:col-span-3">
            <select class="w-s form-select box mt-3 xsd-mt-3 sm:mt-0" wire:model="selected_project_id">
                <option value="">All Projects</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select class="w-s form-select box d-mt-3 sm:mt-0" wire:model="selected_category_id">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select class="w-s form-select box d-mt-3 sm:mt-0" wire:model="selected_status_id">
                <option value="">All Statuses</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select class="w-s form-select box d-mt-3 sm:mt-0" wire:model="selected_priority_id">
                <option value="">All Priorities</option>
                @foreach($priorities as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select class="w-s form-select box xs-mt-3 sm:mt-0" wire:model="selected_reported_by_user_id">
                <option value="">Reported by All</option>
                @foreach($reporter_users as $reporter_user)
                    <option value="{{ $reporter_user->id }}">{{ $reporter_user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select class="w-s form-select box xs-mt-3 sm:mt-0" wire:model="selected_assigned_to_user_id">
                <option value="">Assigned to All</option>
                @foreach($assigned_users as $assigned_user)
                    <option value="{{ $assigned_user->id }}">{{ $assigned_user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <input type="date" class="form-control box xs-mt-3 sm:mt-0" wire:model="selected_submitted_at_from">
        </div>
        <div class="col-span-12 lg:col-span-3">
            <input type="date" class="form-control box xs-mt-3 sm:mt-0" wire:model="selected_submitted_at_to">
        </div>
    </div>

    <div class="@if($view_type == 'grid') grid mt-5 @endif grid-cols-12 gap-6 ">
        @if($view_type == 'grid')
            @foreach($tickets as $ticket)
                <div class="intro-y col-span-12 md:col-span-6 lg:col-span-3" wire:loading.remove>
                    <div class="box">
                        <div class="flex items-start px-5 pt-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="Profile Picture" class="rounded-full" src="{{ $ticket->project->photo_url }}">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="javascript:void(0);" class="font-medium">Ticket #{{ $ticket->id_formatted }}</a>
                                    <div class="text-slate-500 text-xs mt-0.5">{{ $ticket->category->name }}</div>
                                    <div class="text-slate-500 text-xs mt-0.5">{{ $ticket->submitted_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left p-5">
                            <div class="mb-4">{{ $ticket->summary }}</div>
                            <div>
                                <small>
                                    Priority: <span style="color: {{ $ticket->priority->color }};">{{ $ticket->priority->name }}</span>
                                </small>
                                <br>
                                <small>
                                    Reported by
                                    <span class="text-primary">{{ $ticket->reportedByUser->name }}</span>
                                    , assigned to
                                    <span class="text-primary">{{ ($ticket->assignedToUser) ? $ticket->assignedToUser->name : 'no one' }}</span>
                                </small>
                            </div>
                        </div>
                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_show'))
                            <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                                <div class="flex items-center justify-center" style="color: {{ $ticket->status->color }};">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="activity" data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                    </svg>
                                    {{ $ticket->status->name }}

                                    <a class="flex items-center ml-5 text-primary"
                                       href="{{ route('tickets.show', ['ticket' => $ticket->id]) }}">
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
                <table class="table table-report" wire:loading.remove>
                    <thead>
                    <tr>
                        <th class="whitespace-nowrap"></th>
                        <th class="whitespace-nowrap">DETAILS</th>
                        <th class="whitespace-nowrap">SUMMARY</th>
                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_show'))
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="w-20">
                                <img src="{{ $ticket->project->photo_url }}" alt="Logo" class="ml-1" width="100">
                            </td>
                            <td class="w-40">
                                <span class="text-primary" style="font-weight: bold;">#{{ $ticket->id_formatted }}</span>
                                <br>
                                <small>
                                    Status: <span style="color: {{ $ticket->status->color }};">{{ $ticket->status->name }}</span>
                                    <br>
                                    Priority: <span style="color: {{ $ticket->priority->color }};">{{ $ticket->priority->name }}</span>
                                </small>
                            </td>
                            <td>
                                <span class="text-primary" style="font-weight: bold;">{{ $ticket->summary }}</span>
                                <br>
                                <small>
                                    Reported by
                                    <span class="text-primary">{{ $ticket->reportedByUser->name }}</span>
                                    , assigned to
                                    <span class="text-primary">{{ ($ticket->assignedToUser) ? $ticket->assignedToUser->name : 'no one' }}</span>
                                </small>
                                <br>
                                <small>{{ $ticket->category->name }}, submitted {{ $ticket->submitted_at->diffForHumans() }}</small>
                                <span style="font-weight: bold;">
                                </span>
                            </td>
                            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_show'))
                                <td class="table-report__action w-40">
                                    <div class="flex justify-center items-center text-primary">
                                        <a class="flex items-center mr-3" href="{{ route('tickets.show', ['ticket' => $ticket->id]) }}">
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
                @if($tickets->total() > 0)
                    Showing {{ $tickets->count() * ($tickets->currentPage() - 1) + 1 }}-{{ $tickets->count() }} of {{ $tickets->total() }}
                    entries
                @else
                    Showing 0-0 of {{ $tickets->total() }} entries
                @endif
            </div>

            {{ $tickets->links('layouts.custom-pagination') }}

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
