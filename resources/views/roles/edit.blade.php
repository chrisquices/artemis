@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="content">
        <div class="intro-y flex items-center mt-6">
            <h2 class="text-lg font-medium mr-auto">Roles</h2>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">Edit {{ $role->name }}</div>
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
                            Role Information
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST" autocomplete="off"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">Role Information</h2>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col-reverse xl:flex-row flex-col">
                                <div class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-6 mb-4">
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" type="text" class="form-control w-full @error('name') border-danger @enderror"
                                                   name="name" value="{{ old('name') ?? $role->name }}" required>
                                            @error('name')
                                            <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mb-3">
                                            <label for="name" class="form-label">Permissions</label>
                                            <div class="grid grid-cols-12">
                                                @foreach($permission_categories as $key => $permission_category)
                                                    <div class="col-span-6 2xl:col-span-6 mb-5">
                                                        <label for="" class="form-label">{{ $key }}</label>
                                                        @foreach($permission_category as $permission)
                                                            <div class="form-switch mt-2">
                                                                <input id="permission-{{ $permission->id }}" type="checkbox"
                                                                       class="form-check-input mr-3" name="permission_ids[]"
                                                                       @if(in_array($permission->id, $role->permissionRoles->pluck('permission_id')->toArray())) checked @endif
                                                                       value="{{ $permission->id }}" >
                                                                <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-3">Save</button>
                                <a href="{{ route('roles.show', ['role' => $role->id]) }}" type="button"
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
