@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="content">
        <div class="intro-y flex items-center mt-6">
            <h2 class="text-lg font-medium mr-auto">{{ $role->name }}</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Profile Picture" class="rounded-full" src="{{ asset('assets/images/logo.png') }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base">{{ $role->name }}</div>
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
                    @if(\App\Classes\PermissionChecker::instance()->hasPermission(['manage_roles_edit', 'manage_roles_delete']))
                        <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400 flex">
                            <div class="flex items-center justify-center">
                                @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_edit'))
                                    <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="text-primary flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             icon-name="edit" data-lucide="edit" class="lucide lucide-check-square w-4 h-4 mr-2">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg>
                                        Edit
                                    </a>
                                @endif
                                @if(\App\Classes\PermissionChecker::instance()->hasPermission('manage_roles_delete'))
                                    <form action="{{ route('roles.delete', ['role' => $role->id]) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this role?');">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="text-danger flex items-center ml-4" onclick="$(this).parent().submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="trash-2"
                                                 data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                            Delete Role
                                        </a>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
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
                                        <input id="name" type="text" class="form-control w-full" name="name" value="{{ $role->name }}"
                                               disabled>
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
                                                                   @if(in_array($permission->id, $role->permissionRoles->pluck('permission_id')->toArray())) checked
                                                                   @endif
                                                                   value="{{ $permission->id }}" disabled>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
