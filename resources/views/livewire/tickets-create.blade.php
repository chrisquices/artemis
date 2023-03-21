<div class="content">
    <div class="intro-y flex items-center mt-6">
        <h2 class="text-lg font-medium mr-auto">Tickets</h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">Add a New Ticket</div>
                        <div class="text-slate-500">Complete the form to continue</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center text-primary font-medium" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                             data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        Ticket Information
                    </a>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <form action="{{ route('tickets.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
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
                                        <select name="project_id" id="project_id" wire:model="selected_project_id"
                                                class="form-select w-full @error('project_id') border-danger @enderror" required>
                                            <option value="" selected disabled>Select a Project</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}" @if(old('project_id') == $project->id) selected @endif>{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id"
                                                class="form-select w-full @error('category_id') border-danger @enderror" required>
                                            <option value="" selected disabled>Select a Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="priority_id" class="form-label">Priority</label>
                                        <select name="priority_id" id="priority_id"
                                                class="form-select w-full @error('priority_id') border-danger @enderror" required>
                                            <option value="" selected disabled>Select a Priority</option>
                                            @foreach($priorities as $priority)
                                                <option value="{{ $priority->id }}" @if(old('priority_id') == $priority->id) selected @endif>{{ $priority->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('priority_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="status_id" class="form-label">Status</label>
                                        <select name="status_id" id="status_id"
                                                class="form-select w-full @error('status_id') border-danger @enderror" required>
                                            <option value="" selected disabled>Select a Status</option>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" @if(old('status_id') == $status->id) selected @endif>{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="reported_by_user_id" class="form-label">Reported By</label>
                                        <select name="reported_by_user_id" id="reported_by_user_id"
                                                class="form-select w-full @error('reported_by_user_id') border-danger @enderror" required>
                                            <option value="" selected disabled>Select a User</option>
                                            @foreach($reporter_users as $reported_by_user)
                                                <option value="{{ $reported_by_user->id }}" @if(old('reported_by_user_id') == $reported_by_user->id) selected @endif>{{ $reported_by_user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('reported_by_user_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="assigned_to_user_id" class="form-label">Assigned To</label>
                                        <select name="assigned_to_user_id" id="assigned_to_user_id"
                                                class="form-select w-full @error('assigned_to_user_id') border-danger @enderror">
                                            <option value="" selected>No one</option>
                                            @foreach($assigned_users as $assigned_to_user)
                                                <option value="{{ $assigned_to_user->id }}" @if(old('assigned_to_user_id') == $assigned_to_user->id) selected @endif>{{ $assigned_to_user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assigned_to_user_id')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-3">
                                        <label for="summary" class="form-label">Summary</label>
                                        <input id="summary" type="text"
                                               class="form-control w-full @error('summary') border-danger @enderror"
                                               name="summary" value="{{ old('summary') }}" required>
                                        @error('summary')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-3">
                                        <label for="started_at" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="5"
                                                  class="form-control w-full @error('started_at') border-danger @enderror"
                                                  required>{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="tags" class="form-label">Tags</label>
                                        <input id="tags" type="text"
                                               class="form-control w-full @error('tags') border-danger @enderror"
                                               name="tags" value="{{ old('tags') }}">
                                        @error('tags')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="submitted_at" class="form-label">Date of Submission</label>
                                        <input id="submitted_at" type="date"
                                               class="form-control w-full @error('submitted_at') border-danger @enderror"
                                               name="submitted_at" value="{{ date('Y-m-d') }}" required>
                                        @error('submitted_at')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-3">Save</button>
                            <a href="{{ route('tickets.index') }}" type="button"
                               class="btn btn-outline-secondary w-20 mr-auto">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
