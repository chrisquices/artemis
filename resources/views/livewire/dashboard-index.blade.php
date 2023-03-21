<div class="content">
    <div class="relative">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 mt-4">
                <div class="intro-y mt-2">
                    <div class="alert alert-dismissible show box bg-primary text-white flex items-center mb-6" role="alert">
                            <span>
                                This is a demo, the database has been populated with dummy data, you are free to do whatever you want in Artemis
                                <button class="rounded-md bg-white bg-opacity-20 dark:bg-darkmode-300 hover:bg-opacity-30 py-0.5 px-2 -my-3 ml-2">Have fun!</button>
                            </span>
                        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"><i data-lucide="x"
                                                                                                                         class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Dashboard
                    </h2>
                </div>
            </div>

            <div class="col-span-12 ">

                <div class="mb-3 grid grid-cols-12 sm:gap-10 intro-y">
                    <div class="col-span-12 pb- relative text-center sm:text-left">
                        <div class="text-sm 2xl:text-base font-medium -mb-1">
                            Hi {{ auth()->user()->name }},
                            <span class="text-slate-600 dark:text-slate-300 font-normal">welcome back!</span>
                        </div>
                    </div>
                </div>
            </div>
            @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_announcements_index'))
                <div class="report-box-3 px-5 pt-5 pb-14 col-span-12 z-10">
                    <div class="grid grid-cols-12 gap-6 relative intro-y">
                        <div class="col-span-12">
                            <div class="intro-x flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-auto">
                                    Unread Announcements ({{ $latest_announcements->count() }})
                                </h2>
                                <button data-carousel="important-notes" data-target="prev"
                                        class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="chevron-left" data-lucide="chevron-left" class="lucide lucide-chevron-left w-4 h-4">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                </button>
                                <button data-carousel="important-notes" data-target="next"
                                        class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         icon-name="chevron-right" data-lucide="chevron-right" class="lucide lucide-chevron-right w-4 h-4">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-5 intro-x">
                                @if($latest_announcements->count() > 0)
                                    <div class="box ">
                                        <div class="tns-outer" id="important-notes-ow">
                                            <button type="button" data-action="stop">
                                                <span class="tns-visually-hidden">stop animation</span>
                                                stop
                                            </button>
                                            <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">
                                                slide
                                                <span class="current">4</span>
                                                of 3
                                            </div>
                                            <div id="important-notes-mw" class="tns-ovh" wire:ignore>
                                                <div class="tns-inner" id="important-notes-iw">
                                                    <div class="tiny-slider  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                                         id="important-notes"
                                                         style="transform: translate3d(-60%, 0px, 0px); transition-duration: 0s;">
                                                        @foreach($latest_announcements as $latest_announcement)
                                                            <div class="p-5 tns-item"
                                                                 id="important-notes-item{{ $latest_announcement->id }}"
                                                                 aria-hidden="true" tabindex="-1">
                                                                <div class="text-base font-medium truncate">
                                                                    {{ $latest_announcement->title }}
                                                                </div>
                                                                <div class="text-slate-400 mt-1">
                                                                    {{ $latest_announcement->user->name }},
                                                                    {{ $latest_announcement->submitted_at->diffForHumans() }}
                                                                </div>
                                                                <div class="text-slate-500 text-justify mt-1">
                                                                    {{ $latest_announcement->message }}
                                                                </div>
                                                                <div class="font-medium flex mt-5">
                                                                    <button type="button" class="btn btn-secondary py-1 px-2">View All Notes
                                                                    </button>
                                                                    <button type="button"
                                                                            class="btn btn-outline-secondary py-1 px-2 ml-auto ml-auto"
                                                                            onclick="$(this).parent().parent().fadeOut();"
                                                                            wire:click="dismissAnnouncementUser({{ $latest_announcement->id }})">
                                                                        Dismiss
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>No unread annnouncements</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mb-5"></div>
            @endif
        </div>
    </div>

    @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_tickets_show'))
        <div class="report-box-3 report-box-3--content grid grid-cols-12 gap-6 xl:-mt-5 2xl:-mt-8 -mb-10 z-40 2xl:z-10">
            <div class="col-span-12">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 mt-6">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Latest Notes From My Projects</h2>
                        </div>
                        <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                            @if($latest_notes->count() > 0)
                                <table class="table table-report mb-4">
                                    <tbody>
                                    @foreach($latest_notes as $note)
                                        <tr>
                                            <td class="w-20">
                                                <img src="{{ $note->ticket->project->photo_url }}" alt="Logo" class="rounded-full ml-1"
                                                     width="65">
                                            </td>
                                            <td class="w-40">
                                            <span class="text-primary" style="font-weight: bold;">
                                                <a href="{{ route('tickets.show', ['ticket' => $note->ticket->id]) }}">
                                                    #{{ $note->ticket->id_formatted }}
                                                </a>
                                            </span>
                                                <br>
                                                <small>
                                                    Status: <span
                                                            style="color: {{ $note->ticket->status->color }};">{{ $note->ticket->status->name }}</span>
                                                    <br>
                                                    Priority: <span
                                                            style="color: {{ $note->ticket->priority->color }};">{{ $note->ticket->priority->name }}</span>
                                                </small>
                                            </td>
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
                            @else
                                <p class="mt-5">No notes available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
