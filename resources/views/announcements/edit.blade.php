@extends('layouts.app')
@section('title', 'Announcements')
@section('content')
    <div class="content">
        <div class="intro-y flex items-center mt-6">
            <h2 class="text-lg font-medium mr-auto">Announcements</h2>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">Edit {{ $announcement->name }}</div>
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
                            Announcement Information
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <form action="{{ route('announcements.update', ['announcement' => $announcement->id]) }}" method="POST" autocomplete="off"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">Announcement Information</h2>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col-reverse xl:flex-row flex-col">
                                <div class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12 mb-4">
                                            <label for="status_id" class="form-label">Status</label>
                                            <div class="flex flex-col sm:flex-row mt-2">
                                                <div class="form-check mr-5 mt-2 sm:mt-0">
                                                    <input id="is_active-1" class="form-check-input" type="radio" name="is_active" value="1"
                                                           @if($announcement->is_active) checked @endif>
                                                    <label class="form-check-label" for="is_active-1">Active</label>
                                                </div>
                                                <div class="form-check mr-5">
                                                    <input id="is_active-2" class="form-check-input" type="radio" name="is_active" value="0"
                                                           @if(!$announcement->is_active) checked @endif>
                                                    <label class="form-check-label" for="is_active-2">Inactive</label>
                                                </div>
                                            </div>
                                            @error('is_active')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mb-4">
                                            <label for="title" class="form-label">Title</label>
                                            <input id="title" type="text"
                                                   class="form-control w-full @error('title') border-danger @enderror"
                                                   name="title" value="{{ old('title') ?? $announcement->title }}" required>
                                            @error('title')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mb-4">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea name="message" id="message" cols="30" rows="5" class="form-control w-full"
                                                      required>{{ old('message') ?? $announcement->message }}</textarea>
                                            @error('message')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-6 xl:col-span-6 mb-4">
                                            <label for="submitted_by" class="form-label">Submitted By</label>
                                            <input id="submitted_by" type="text" class="form-control w-full"value="{{ auth()->user()->name }}" disabled>
                                        </div>
                                        <div class="col-span-6 xl:col-span-6 mb-4">
                                            <label for="submitted_at" class="form-label">Date of Submission</label>
                                            <input id="submitted_at" type="date"
                                                   class="form-control w-full @error('submitted_at') border-danger @enderror"
                                                   name="submitted_at" value="{{ old('submitted_at') ?? $announcement->submitted_at->format('Y-m-d') ?? date('Y-m-d') }}" required>
                                            @error('submitted_at')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-3">Save</button>
                                <a href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}" type="button"
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
