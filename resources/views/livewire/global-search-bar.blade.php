<div class="intro-x relative mr-6 sm:mr-6 xs-hide">
    <div class="search hidden sm:block">
        <input type="text" class="search__input form-control border-transparent" placeholder="Search..." wire:model="search_term">
        <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
    </div>
    <a class="notification notification--light sm:hidden" href="">
        <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
    </a>
    <div class="search-result" wire:ignore.self>
        <div class="search-result__content">
            <div class="search-result__content__title">Projects</div>
            <div class="mb-5">
                @if(count($projects) > 0)
                    @foreach($projects as $project)
                        <a href="{{ route('projects.show', ['project' => $project->id]) }}" class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                                <img alt="Project Logo" class="rounded-full" src="{{ $project->photo_url }}">
                            </div>
                            <div class="ml-3">{{ $project->name }}</div>
                        </a>
                    @endforeach
                @else
                    <p>No projects were found.</p>
                @endif
            </div>
            <div class="search-result__content__title">Tickets</div>
            <div class="">
                @if(count($tickets) > 0)
                    @foreach($tickets as $ticket)
                        <a href="{{ route('tickets.show', ['ticket' => $ticket->id]) }}" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Project Logo" class="rounded-full" src="{{ $ticket->project->photo_url }}">
                            </div>
                            <div class="ml-3">
                                {{ strlen($ticket->summary) > 50 ? substr($ticket->summary,0,50)."..." : $ticket->summary }}
                                <br>
                                <small>
                                    Status: <span style="color: {{ $ticket->status->color }};">{{ $ticket->status->name }}</span>
                                    <br>
                                    Priority: <span style="color: {{ $ticket->priority->color }};">{{ $ticket->priority->name }}</span>
                                </small>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>No tickets were found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
