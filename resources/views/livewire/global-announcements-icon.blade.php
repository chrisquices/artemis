<div class="intro-x dropdown mr-6 sm:mr-">
    <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false"
         data-tw-toggle="dropdown"><i data-lucide="bell" class="notification__icon dark:text-slate-500"></i></div>
    <div class="notification-content pt-2 dropdown-menu">
        <div class="notification-content__box dropdown-content">
            <div class="notification-content__title">
                Unread Announcements ({{ $unread_announcements->count() }})
                <a href="{{ route('announcements.index') }}" class="text-primary" style="text-decoration: underline;">
                    (View all)
                </a>
            </div>

            @if($unread_announcements->count() > 0)
                @foreach($unread_announcements->take(5) as $unread_announcement)
                    <div class="cursor-pointer relative flex items-center @if(!$loop->first) mt-5 @endif">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            <img alt="Profile Picture" class="rounded-full" src="{{ $unread_announcement->user->photo_url }}">
                        </div>
                        <div class="ml-2 overflow-hidden" onclick="redirectTo('{{ route('announcements.show', ['announcement' => $unread_announcement->id]) }}')">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5">{{ $unread_announcement->user->name }}</a>
                                <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">
                                    {{ $unread_announcement->submitted_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="w-full truncate text-slate-500 mt-0.5">
                                {{ $unread_announcement->message }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No unread announcements</p>
            @endif
        </div>
    </div>
</div>
