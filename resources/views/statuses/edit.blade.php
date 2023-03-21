@extends('layouts.app')
@section('title', 'Statuses')
@section('content')
    <div class="content">
        <div class="intro-y flex items-center mt-6">
            <h2 class="text-lg font-medium mr-auto">Statuses</h2>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">Edit {{ $status->name }}</div>
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
                            Status Information
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <form action="{{ route('statuses.update', ['status' => $status->id]) }}" method="POST" autocomplete="off"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">Status Information</h2>
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
                                                           @if($status->is_active) checked @endif>
                                                    <label class="form-check-label" for="is_active-1">Active</label>
                                                </div>
                                                <div class="form-check mr-5">
                                                    <input id="is_active-2" class="form-check-input" type="radio" name="is_active" value="0"
                                                           @if(!$status->is_active) checked @endif>
                                                    <label class="form-check-label" for="is_active-2">Inactive</label>
                                                </div>
                                            </div>
                                            @error('is_active')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 mb-4">
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" type="text" class="form-control w-full @error('name') border-danger @enderror"
                                                   name="name" value="{{ old('name') ?? $status->name }}" required>
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 mb-4">
                                            <label for="type" class="form-label">Type</label>
                                            <select name="type" id="type" class="form-select w-full @error('type') border-danger @enderror" required>
                                                <option value="Project" @if($status->type == 'Project') selected @endif>Project</option>
                                                <option value="Ticket" @if($status->type == 'Ticket') selected @endif>Ticket</option>
                                            </select>
                                            @error('type')<div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-6 mb-4">
                                            <label for="color" class="form-label">Color (Hex Code)</label>
                                            <input id="color" type="text" class="form-control w-full @error('color') border-danger @enderror"
                                                   name="color" value="{{ old('color') ?? $status->color }}" required>
                                            @error('color')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-3">Save</button>
                                <a href="{{ route('statuses.show', ['status' => $status->id]) }}" type="button"
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
