<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roles = [
			[
				"name" => 'Administrator',
			],
			[
				"name" => 'Manager',
			],
			[
				"name" => 'Software Engineer',
			],
			[
				"name" => 'QA Engineer',
			],
		];

		foreach ($roles as $role) {
			$new_role = new Role();
			$new_role->name = $role['name'];
			$new_role->save();
		}

		$permissions = Permission::all();

		foreach ($permissions as $permission) {
			$new_permission_role = new PermissionRole();
			$new_permission_role->permission_id = $permission->id;
			$new_permission_role->role_id = 1;
			$new_permission_role->save();
		}

		$permissions = Permission::where('name', 'not like', '%' . 'Delete' . '%')->get();

		foreach ($permissions as $permission) {
			$new_permission_role = new PermissionRole();
			$new_permission_role->permission_id = $permission->id;
			$new_permission_role->role_id = 2;
			$new_permission_role->save();
		}

		$permissions = Permission::query()
			->where('name', 'not like', '%' . 'Create Projects' . '%')
			->where('name', 'not like', '%' . 'Create Announcements' . '%')
			->where('name', 'not like', '%' . 'Edit' . '%')
			->where('name', 'not like', '%' . 'Delete' . '%')
			->where('name', 'not like', '%' . 'Users' . '%')
			->where('name', 'not like', '%' . 'Categories' . '%')
			->where('name', 'not like', '%' . 'Statuses' . '%')
			->where('name', 'not like', '%' . 'Priorities' . '%')
			->where('name', 'not like', '%' . 'Roles & Permissions' . '%')
			->get();

		foreach ($permissions as $permission) {
			$new_permission_role = new PermissionRole();
			$new_permission_role->permission_id = $permission->id;
			$new_permission_role->role_id = 3;
			$new_permission_role->save();
		}

		foreach ($permissions as $permission) {
			$new_permission_role = new PermissionRole();
			$new_permission_role->permission_id = $permission->id;
			$new_permission_role->role_id = 4;
			$new_permission_role->save();
		}

	}

}
