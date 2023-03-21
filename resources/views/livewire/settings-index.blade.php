<div class="content">
    <div class="intro-y flex items-center mt-6">
        <h2 class="text-lg font-medium mr-auto">Settings</h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">Configure Artemis Settings</div>
                        <div class="text-slate-500">Select a menu to continue</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center @if($active_menu == 'categories') text-primary @endif font-medium" href="#"
                       wire:click="updateActiveMenu('categories')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Categories
                    </a>
                    <a class="flex items-center @if($active_menu == 'statuses') text-primary @endif font-medium mt-5" href="#"
                       wire:click="updateActiveMenu('statuses')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Statuses
                    </a>
                    <a class="flex items-center @if($active_menu == 'priorities') text-primary @endif font-medium mt-5" href="#"
                       wire:click="updateActiveMenu('priorities')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Priorities
                    </a>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">

            @if($active_menu == 'categories')
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Categories</h2>
                    </div>
                </div>
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report">
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="table- w-40">
                                    @if($category->is_active)
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
                                <td>
                                    <form id="form-category-{{ $category->id }}"
                                          action="{{ route('settings.update_category', ['category' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                                    </form>
                                </td>
                                <td class="table-report__action w-20">
                                    <div class="flex justify-center items-center text-primary">
                                        <a class="flex items-center" href="javascript:void(0);"
                                           wire:click="toggleCategory({{ $category->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="refresh-cw" data-lucide="refresh-cw"
                                                 class="lucide lucide-refresh-cw w-4 h-4 mr-1">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="table-report__action w-20" onclick="$('#form-category-{{ $category->id }}').submit();">
                                    <div class="flex justify-center items-center text-primary">
                                        <a class="flex items-center" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="save" data-lucide="save" class="lucide lucide-activity w-4 h-4 mr-1">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if($active_menu == 'statuses')
                <div class="intro-y box mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Statuses</h2>
                    </div>
                </div>
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report">
                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td class="table- w-40">
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
                                <td>
                                    <form id="form-status-{{ $status->id }}"
                                          action="{{ route('settings.update_status', ['status' => $status->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $status->name }}"
                                               required>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <input type="text" class="form-control mr-1" name="color" placeholder="Color (Hex)"
                                                   value="{{ $status->color }}" required>
                                            <select name="category" id="category" class="form-select ml-1" required>
                                                <option value="Project" @if($status->category == 'Project') selected @endif>Project</option>
                                                <option value="Ticket" @if($status->category == 'Ticket') selected @endif>Ticket</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                                <td class="table-report__action w-20" onclick="$('#form-status-{{ $status->id }}').submit();">
                                    <div class="flex justify-center items-center text-primary">
                                        <a class="flex items-center" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="save" data-lucide="save" class="lucide lucide-activity w-4 h-4 mr-1">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="table-report__action w-20">
                                    <div class="flex justify-center items-center text-primary">
                                        <form id="form-status-{{ $status->id }}"
                                              action="{{ route('settings.toggle_status', ['status' => $status->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <a class="flex items-center" href="javascript:void(0);" onclick="$(this).parent().submit();">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     icon-name="refresh-cw" data-lucide="refresh-cw"
                                                     class="lucide lucide-activity w-4 h-4 mr-1">
                                                    <polyline points="9 11 12 14 22 4"></polyline>
                                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                                </svg>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if($active_menu == 'priorities')
                <div class="intro-y box mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">Priorities</h2>
                    </div>
                </div>
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report">
                        <tbody>
                        @foreach($priorities as $priority)
                            <tr>
                                <td class="table- w-40">
                                    @if($priority->is_active)
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
                                <td>
                                    <form id="form-priority-{{ $priority->id }}"
                                          action="{{ route('settings.update_priority', ['priority' => $priority->id]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $priority->name }}"
                                               required>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <input type="text" class="form-control" name="color" placeholder="Color (Hex)"
                                                   value="{{ $priority->color }}" required>
                                        </div>
                                    </form>
                                </td>
                                <td class="table-report__action w-20" onclick="$('#form-priority-{{ $priority->id }}').submit();">
                                    <div class="flex justify-center items-center text-primary">
                                        <a class="flex items-center" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="save" data-lucide="save" class="lucide lucide-activity w-4 h-4 mr-1">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="table-report__action w-20">
                                    <div class="flex justify-center items-center text-primary">
                                        <form id="form-priority-{{ $priority->id }}"
                                              action="{{ route('settings.toggle_priority', ['priority' => $priority->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <a class="flex items-center" href="javascript:void(0);" onclick="$(this).parent().submit();">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     icon-name="refresh-cw" data-lucide="refresh-cw"
                                                     class="lucide lucide-activity w-4 h-4 mr-1">
                                                    <polyline points="9 11 12 14 22 4"></polyline>
                                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                                </svg>
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</div>
