@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <div class="content">
        <div class="intro-y flex items-center mt-6">
            <h2 class="text-lg font-medium mr-auto">{{ $user->name }}</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <!-- BEGIN: Profile Menu -->
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Profile Picture" class="rounded-full" src="{{ $user->photo_url }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">{{ $user->name }}</div>
                            <div class="text-slate-500">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <a class="flex items-center text-primary font-medium" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="activity"
                                 data-lucide="activity" class="lucide lucide-activity w-4 h-4 mr-2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                            User Information
                        </a>
                    </div>
                    @if(\App\Classes\PermissionChecker::instance()->hasPermission(['manage_users_edit', 'manage_users_delete']))
                        <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400 flex">
                            <div class="flex items-center justify-center">
                                @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_users_edit'))
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="text-primary flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="edit" data-lucide="edit" class="lucide lucide-check-square w-4 h-4 mr-2">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg>
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                {{-- Personal Information --}}
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">User Information</h2>
                    </div>
                    <div class="p-5">
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="name" class="form-label">Status</label>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <div class="form-check mr-5 mt-2 sm:mt-0">
                                                <input id="is_active-1" class="form-check-input" type="radio" name="is_active" value="1"
                                                       @if($user->is_active) checked @endif disabled>
                                                <label class="form-check-label" for="is_active-1">Active</label>
                                            </div>
                                            <div class="form-check mr-5">
                                                <input id="is_active-2" class="form-check-input" type="radio" name="is_active" value="0"
                                                       @if(!$user->is_active) checked @endif disabled>
                                                <label class="form-check-label" for="is_active-2">Inactive</label>
                                            </div>
                                        </div>
                                        @error('is_active')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="name" class="form-label">Type</label>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <div class="form-check mr-5 mt-2 sm:mt-0">
                                                <input id="type-2" class="form-check-input" type="radio" name="type" value="Administrator"
                                                       @if($user->type == 'Administrator') checked @endif disabled>
                                                <label class="form-check-label" for="type-2">Administrator</label>
                                            </div>
                                            <div class="form-check mr-5">
                                                <input id="type-1" class="form-check-input" type="radio" name="type" value="User"
                                                       @if($user->type == 'User') checked @endif disabled>
                                                <label class="form-check-label" for="type-1">User</label>
                                            </div>
                                        </div>
                                        @error('type')
                                        <div class="text-danger mt-2">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" type="text" class="form-control w-full" name="name" value="{{ $user->name }}"
                                               disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mb-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control w-full" name="email" value="{{ $user->email }}"
                                               disabled>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mb-3">
                                        <label for="name" class="form-label">Roles</label>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-6 2xl:col-span-6">
                                                @foreach($roles as $role)
                                                    <div class="form-switch mt-2">
                                                        <input id="role-{{ $role->id }}" type="checkbox" class="form-check-input mr-3"
                                                               @if(in_array($role->id, $user->roleUsers->pluck('role_id')->toArray())) checked
                                                               @endif
                                                               name="role_ids[]" value="{{ $role->id }}" disabled>
                                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="Profile Picture" src="{{ $user->photo_url }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
