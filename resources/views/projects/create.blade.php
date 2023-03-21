@extends('layouts.app')
@section('title', 'Projects')
@section('content')
    <div class="content">
        <div class="intro-y flex items-center mt-6">
            <h2 class="text-lg font-medium mr-auto">Projects</h2>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">Add a New Project</div>
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
                            Project Information
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <form action="{{ route('projects.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">Project Information</h2>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col-reverse xl:flex-row flex-col">
                                <div class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12 mb-4">
                                            <label for="status_id" class="form-label">Status</label>
                                            <div class="flex flex-col sm:flex-row mt-2">
                                                @foreach($statuses as $status)
                                                    <div class="form-check mr-5">
                                                        <input id="status_id-{{ $status->id }}" class="form-check-input" type="radio" name="status_id" value="{{ $status->id }}" @if($loop->first) checked @endif>
                                                        <label class="form-check-label" for="status_id-{{ $status->id }}">{{ $status->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('status_id')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 mb-4">
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" type="text" class="form-control w-full @error('name') border-danger @enderror"
                                                   name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 mb-4">
                                            <label for="started_at" class="form-label">Start Date</label>
                                            <input id="started_at" type="date"
                                                   class="form-control w-full @error('started_at') border-danger @enderror"
                                                   name="started_at" value="{{ old('started_at') ?? date('Y-m-d') }}" required>
                                            @error('started_at')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mb-4">
                                            <label for="description" class="form-label">Description</label>
                                            <input id="description" type="text"
                                                   class="form-control w-full @error('description') border-danger @enderror"
                                                   name="description" value="{{ old('description') }}" required>
                                            @error('description')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            <img class="rounded-md" alt="Profile Picture" src="{{ asset('assets/images/profile-3.jpg') }}"
                                                 id="photo-preview">
                                            <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"
                                                 id="btn-remove-photo">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="mx-auto cursor-pointer relative mt-5">
                                            <button type="button" class="btn btn-primary w-full" id="btn-select-photo">Select Photo</button>
                                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" id="photo"
                                                   name="photo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-3">Save</button>
                                <a href="{{ route('projects.index') }}" type="button"
                                   class="btn btn-outline-secondary w-20 mr-auto">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#btn-select-photo').on('click', function () {
            $('#photo').click();
        });

        $('#btn-remove-photo').on('click', function () {
            $('#photo').val('');
            $('#photo-preview').attr('src', '{{ asset('assets/images/profile-3.jpg') }}');
        });

        $("#photo").change(function () {
            readPhotoURL(this);
        });

        function readPhotoURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
