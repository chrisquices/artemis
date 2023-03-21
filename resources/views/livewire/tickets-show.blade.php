<div class="content">
    <div class="intro-y flex items-center mt-6">
        <h2 class="text-lg font-medium mr-auto">{{ $ticket->name }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Profile Picture" class="rounded-full" src="{{ $ticket->project->photo_url }}"
                             style="width: 500px !important;">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">Ticket #{{ $ticket->id_formatted }}</div>
                        <div class="text-slate-500">{{ $ticket->category->name }}</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center @if($active_menu == 'ticket-information') text-primary @endif font-medium"
                       href="javascript:void(0);" wire:click="changeActiveMenu('ticket-information')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2" wire:ignore>
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Ticket Information
                    </a>
                    <a class="flex items-center @if($active_menu == 'project-information') text-primary @endif font-medium mt-4"
                       href="javascript:void(0);" wire:click="changeActiveMenu('project-information')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2" wire:ignore>
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Project Information

                        @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_projects_show'))
                            <span class="ml-1 text-primary" style="text-decoration: underline;"
                                  onclick="redirectTo('{{ route('projects.show', ['project' => $ticket->project->id]) }}')">
                                ({{ $ticket->project->name }})
                            </span>
                        @endif
                    </a>

                    <a class="flex items-center @if($active_menu == 'notes') text-primary @endif font-medium mt-4"
                       href="javascript:void(0);" wire:click="changeActiveMenu('notes')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2" wire:ignore>
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Notes ({{ $ticket->notes->count() }})
                    </a>
                </div>
                @if(\App\Classes\PermissionChecker::instance()->hasPermission(['manage_tickets_edit', 'manage_tickets_delete']))
                    <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400 flex">
                        <div class="flex items-center justify-center">
                            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_edit'))
                                <a href="{{ route('tickets.edit', ['ticket' => $ticket->id]) }}"
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

                            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_delete'))
                                <form action="{{ route('tickets.delete', ['ticket' => $ticket->id]) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this ticket?');">
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
                                        Delete Ticket
                                    </a>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            @if($active_menu == 'ticket-information')
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Ticket Information</h2>
                    </div>
                    <div class="p-5">
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="project_id" class="form-label">Project</label>
                                        <input id="project_id" type="text" class="form-control w-full" name="project_id"
                                               value="{{ $ticket->project->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="category_id" class="form-label">Category</label>
                                        <input id="category_id" type="text" class="form-control w-full" name="category_id"
                                               value="{{ $ticket->category->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="priority_id" class="form-label">Priority</label>
                                        <input id="priority_id" type="text" class="form-control w-full" name="priority_id"
                                               style="color: {{ $ticket->priority->color }}; font-weight: bold;"
                                               value="{{ $ticket->priority->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="status_id" class="form-label">Status</label>
                                        <input id="status_id" type="text" class="form-control w-full" name="status_id"
                                               style="color: {{ $ticket->status->color }}; font-weight: bold;"
                                               value="{{ $ticket->status->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="reported_by_user_id" class="form-label">Reported By</label>
                                        <input id="reported_by_user_id" type="text" class="form-control w-full" name="reported_by_user_id"
                                               value="{{ $ticket->reportedByUser->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="assigned_to_user_id" class="form-label">Assigned To</label>
                                        <input id="assigned_to_user_id" type="text" class="form-control w-full" name="assigned_to_user_id"
                                               value="{{ ($ticket->assignedToUser) ? $ticket->assignedToUser->name : 'No one' }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-4">
                                        <label for="summary" class="form-label">Summary</label>
                                        <input id="summary_id" type="text" class="form-control w-full" name="summary_id"
                                               value="{{ $ticket->summary }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-4">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control w-full"
                                                  disabled>{{ $ticket->description }}</textarea>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="tags" class="form-label">Tags</label>
                                        <input id="tags" type="text" class="form-control w-full" name="tags" value="{{ $ticket->tags }}"
                                               disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="submitted_at" class="form-label">Date of Submission</label>
                                        <input id="submitted_at" type="text" class="form-control w-full" name="submitted_at"
                                               value="{{ $ticket->submitted_at->format('Y-m-d') }}, {{ $ticket->submitted_at->diffForHumans() }}"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
                                                <input id="status_id-{{ $ticket->project->status->id }}" class="form-check-input"
                                                       type="radio"
                                                       name="status_id" value="{{ $ticket->project->status->id }}" checked disabled>
                                                <label class="form-check-label"
                                                       for="status_id-{{ $ticket->project->status->id }}">{{ $ticket->project->status->name }}</label>
                                            </div>
                                        </div>
                                        @error('status_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" type="text" class="form-control w-full"
                                               name="name" value="{{ $ticket->project->name }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="started_at" class="form-label">Start Date</label>
                                        <input id="started_at" type="date" class="form-control w-full" name="started_at"
                                               value="{{ $ticket->project->started_at }}" disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-4">
                                        <label for="project_description" class="form-label">Description</label>
                                        <input id="project_description" type="text" class="form-control w-full" name="project_description"
                                               value="{{ $ticket->project->description }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="Profile Picture" src="{{ $ticket->project->photo_url }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($active_menu == 'notes')
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Notes ({{ $ticket->notes->count() }})</h2>
                    </div>
                </div>

                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report">
                        <tbody>
                        @foreach($notes as $note)
                            <tr>
                                <td class="w-20">
                                    <img src="{{ $note->user->photo_url }}" alt="Logo" class="rounded-full ml-1" width="65">
                                </td>
                                <td class="w-40">
                                    {{ $note->user->name }}
                                    <br>
                                    <small>
                                        @if($note->is_reporter)
                                            Reporter
                                        @endif
                                        @if($note->is_assigned)
                                            Assigned To
                                        @endif
                                        @if($note->is_supervisor)
                                            Supervisor
                                        @endif
                                        @if($note->user->type == 'Administrator')
                                            Administrator
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    {{ $note->content }}
                                    <br>
                                    <small>
                                        {{ $note->submitted_at }}
                                        @if($note->user_id == auth()->user()->id && $note->submitted_at->diffInSeconds() <= 3600)
                                            <span class="text-danger cursor-pointer"
                                                  wire:click="deleteNote({{ $note->id }})">(Delete)</span>
                                        @endif
                                    </small>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-span-12 @if($notes->count() == 0) mt-2 @endif">
                    <textarea name="new_note" id="new_note" cols="30" rows="3" class="form-control w-full required" wire:model="content"
                              placeholder="Enter your note here"></textarea>
                    <button type="button" class="btn btn-primary w-40 mt-2 float-right" wire:click="storeNote">Send Note</button>
                </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
    <script>
        window.addEventListener('missingNote', (e) => {
            toastr.error('Cannot submit an empty note!')
        });

        window.addEventListener('noteSubmitted', (e) => {
            toastr.success('Your note has been submitted!')
        });
    </script>
@endsection
