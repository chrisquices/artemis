<div class="content">
    <div class="intro-y flex items-center mt-6">
        <h2 class="text-lg font-medium mr-auto">{{ $project->name }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Profile Picture" class="rounded-full" src="{{ $project->photo_url }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ $project->name }}</div>
                        <div class="text-slate-500" style="color: {{ $project->status->color }};">{{ $project->status->name }}</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center @if($active_menu == 'project-information') text-primary @endif font-medium"
                       href="javascript:void(0);" wire:click="changeActiveMenu('project-information')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2" wire:ignore>
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Project Information
                    </a>
                    <a class="flex items-center @if($active_menu == 'members') text-primary @endif font-medium mt-4"
                       href="javascript:void(0);" wire:click="changeActiveMenu('members')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="users" class="lucide lucide-users w-4 h-4 mr-2" wire:ignore>
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Members ({{ $members->count() }})
                    </a>
                    <a class="flex items-center @if($active_menu == 'tickets') text-primary @endif font-medium mt-4"
                       href="javascript:void(0);" wire:click="changeActiveMenu('tickets')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2" wire:ignore>
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Tickets ({{ $project->tickets->count() }})
                    </a>
                </div>
                @if(\App\Classes\PermissionChecker::instance()->hasPermission(['manage_projects_edit', 'manage_projects_delete']))
                    <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400 flex">
                        <div class="flex items-center justify-center">
                            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_projects_edit'))
                                <a href="{{ route('projects.edit', ['project' => $project->id]) }}"
                                   class="text-primary flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="edit" data-lucide="edit" class="lucide lucide-activity w-4 h-4 mr-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                    </svg>
                                    Edit
                                </a>
                            @endif

                            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_projects_delete'))
                                <form action="{{ route('projects.delete', ['project' => $project->id]) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" class="text-danger flex items-center ml-4" onclick="$(this).parent().submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="trash-2"
                                             data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Delete Project
                                    </a>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            @if($active_menu == 'project-information')
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Project Information</h2>
                    </div>
                    <div class="p-5">
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mb-4">
                                        <label for="name" class="form-label">Status</label>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <div class="form-check mr-5">
                                                <input id="status_id-{{ $project->status->id }}" class="form-check-input" type="radio"
                                                       name="status_id" value="{{ $project->status->id }}" checked disabled>
                                                <label class="form-check-label"
                                                       for="status_id-{{ $project->status->id }}">{{ $project->status->name }}</label>
                                            </div>
                                        </div>
                                        @error('status_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" type="text" class="form-control w-full"
                                               name="name" value="{{ $project->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="started_at" class="form-label">Start Date</label>
                                        <input id="started_at" type="date" class="form-control w-full" name="started_at"
                                               value="{{ $project->started_at }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input id="description" type="text" class="form-control w-full" name="description"
                                               value="{{ $project->description }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="Profile Picture" src="{{ $project->photo_url }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($active_menu == 'members')
                <div class="intro-y box lg:mt-5">
                    <div class="flex xs-no-flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto xs-w-100">Members ({{ $members->count() }})</h2>

                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_projects_edit'))
                            <div class="form-check mr-5 xs-mt-4">
                                <input id="is-supervisor" class="form-check-input" type="checkbox" value="1"
                                       wire:model="selected_is_supervisor">
                                <label class="form-check-label" for="is-supervisor">Supervisor</label>
                            </div>

                            <div class="w-56 relative text-slate-500 xs-w-100 xs-mt-4 d-mr-5">
                                <select name="user_id" id="user_id" class="form select w-56 box pr-10 xs-w-100 d-mr-5 " wire:model="selected_user_id">
                                    <option value="" selected>Member to add</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <a href="javascript:void(0);" class="btn btn-primary shadow-md xs-w-100 xs-mt-4" wire:click="storeProjectUser">
                                Add New Member
                            </a>
                        @endif
                    </div>
                </div>

                @if($members->count() > 0)
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report">
                            <tbody>
                            @foreach($members as $project_user)
                                <tr class="cursor-pointer">
                                    <td class="w-20">
                                        <img src="{{ $project_user->user->photo_url }}" class="rounded-full" alt="Logo" width="20">
                                    </td>
                                    <td>{{ $project_user->user->name }}</td>
                                    <td class="table-report__action w-40 text-center">
                                        @if($project_user->is_supervisor)
                                            Supervisor
                                        @else
                                            Regular Member
                                        @endif
                                    </td>
                                    <td class="table-report__action w-40">
                                        <div class="flex items-center justify-center text-danger"
                                             wire:click="deleteProjectUser({{ $project_user->user->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="trash" data-lucide="trash"
                                                 class="lucide lucide-activity w-4 h-4 mr-2">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                            Remove
                                        </div>
                                    </td>
                                    @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_users_show'))
                                        <td class="table-report__action w-40">
                                            <div class="flex justify-center items-center text-primary">
                                                <a class="flex items-center mr-3"
                                                   href="{{ route('users.show', ['user' => $project_user->user->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                         fill="none"
                                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                         stroke-linejoin="round"
                                                         icon-name="search" data-lucide="search"
                                                         class="lucide lucide-activity w-4 h-4 mr-1">
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
                @else
                    <p class="text-center mt-5 pt-5">No members were found</p>
                @endif
            @endif

            @if($active_menu == 'tickets')
                <div class="intro-y box lg:mt-5">
                    <div class="flex xs-no-flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Tickets ({{ $tickets->count() }})</h2>

                        <div class="w-56 relative text-slate-500 xs-w-100 xs-mt-4 d-mr-5">
                            <input type="text" class="form-control w-56 box pr-10" placeholder="Search..."
                                   wire:model.debounce.500ms="search_term">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search"
                                 class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>

                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_create'))
                            <a href="{{ route('tickets.create', ['project_id' => $project->id]) }}" class="btn btn-primary shadow-md xs-w-100 xs-mt-4">
                                Add New Ticket
                            </a>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-12 d-mt-3">
                    <div class="col-span-12 lg:col-span-3 d-mb-3 d-mr-5">
                        <select class="w-s form-select box mt-3 sm:mt-0">
                            <option value="{{ $project->id }}">Project {{ $project->name }}</option>
                        </select>
                    </div>
                    <div class="col-span-12 lg:col-span-3 d-mb-3 d-mr-5">
                        <select class="w-s form-select box mt-3 sm:mt-0" wire:model="selected_category_id">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 lg:col-span-3 d-mb-3 d-mr-5">
                        <select class="w-s form-select box mt-3 sm:mt-0" wire:model="selected_status_id">
                            <option value="">All Statuses</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 lg:col-span-3">
                        <select class="w-s form-select box mt-3 sm:mt-0" wire:model="selected_priority_id">
                            <option value="">All Priorities</option>
                            @foreach($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 lg:col-span-3 d-mr-5">
                        <select class="w-s form-select box mt-3 sm:mt-0" wire:model="selected_reported_by_user_id">
                            <option value="">Reported by All</option>
                            @foreach($reporter_users as $reporter_user)
                                <option value="{{ $reporter_user->id }}">{{ $reporter_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 lg:col-span-3 d-mr-5">
                        <select class="w-s form-select box mt-3 sm:mt-0" wire:model="selected_assigned_to_user_id">
                            <option value="">Assigned to All</option>
                            @foreach($assigned_users as $assigned_user)
                                <option value="{{ $assigned_user->id }}">{{ $assigned_user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 lg:col-span-3 d-mr-5">
                        <input type="date" class="form-control box mt-3 sm:mt-0" wire:model="selected_submitted_at_from">
                    </div>
                    <div class="col-span-12 lg:col-span-3 mb-">
                        <input type="date" class="form-control box mt-3 sm:mt-0" wire:model="selected_submitted_at_to">
                    </div>
                </div>

                @if($tickets->count() > 0)
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report" wire:loading.remove>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td class="w-40">
                                        <span class="text-primary" style="font-weight: bold;">#{{ $ticket->id_formatted }}</span>
                                        <br>
                                        <small>
                                            Status: <span style="color: {{ $ticket->status->color }};">{{ $ticket->status->name }}</span>
                                            <br>
                                            Priority: <span
                                                    style="color: {{ $ticket->priority->color }};">{{ $ticket->priority->name }}</span>
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
                                                <a class="flex items-center mr-3"
                                                   href="{{ route('tickets.show', ['ticket' => $ticket->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                         fill="none"
                                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                         stroke-linejoin="round"
                                                         icon-name="search" data-lucide="search"
                                                         class="lucide lucide-activity w-4 h-4 mr-1">
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
                @else
                    <p class="text-center mt-5 pt-5">No tickets were found</p>
                @endif

            @endif
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.addEventListener('missingProjectUserId', (e) => {
            toastr.error('Select a member to add to this project')
        });
    </script>
@endsection
