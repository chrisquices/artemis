<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$permissions = [
			// Projects
			[
				'category' => 'Projects',
				'name'     => 'List Projects',
				'code'     => 'manage_projects_index',
			],
			[
				'category' => 'Projects',
				'name'     => 'Create Projects',
				'code'     => 'manage_projects_create',
			],
			[
				'category' => 'Projects',
				'name'     => 'View Projects',
				'code'     => 'manage_projects_show',
			],
			[
				'category' => 'Projects',
				'name'     => 'Edit Projects',
				'code'     => 'manage_projects_edit',
			],
			[
				'category' => 'Projects',
				'name'     => 'Delete Projects',
				'code'     => 'manage_projects_delete',
			],
			// Tickets
			[
				'category' => 'Tickets',
				'name'     => 'List Tickets',
				'code'     => 'manage_tickets_index',
			],
			[
				'category' => 'Tickets',
				'name'     => 'Create Tickets',
				'code'     => 'manage_tickets_create',
			],
			[
				'category' => 'Tickets',
				'name'     => 'View Tickets',
				'code'     => 'manage_tickets_show',
			],
			[
				'category' => 'Tickets',
				'name'     => 'Edit Tickets',
				'code'     => 'manage_tickets_edit',
			],
			[
				'category' => 'Tickets',
				'name'     => 'Delete Tickets',
				'code'     => 'manage_tickets_delete',
			],
			// Announcements
			[
				'category' => 'Announcements',
				'name'     => 'List Announcements',
				'code'     => 'manage_announcements_index',
			],
			[
				'category' => 'Announcements',
				'name'     => 'Create Announcements',
				'code'     => 'manage_announcements_create',
			],
			[
				'category' => 'Announcements',
				'name'     => 'View Announcements',
				'code'     => 'manage_announcements_show',
			],
			[
				'category' => 'Announcements',
				'name'     => 'Edit Announcements',
				'code'     => 'manage_announcements_edit',
			],
			[
				'category' => 'Announcements',
				'name'     => 'Delete Announcements',
				'code'     => 'manage_announcements_delete',
			],
			// Users
			[
				'category' => 'Users',
				'name'     => 'List Users',
				'code'     => 'manage_users_index',
			],
			[
				'category' => 'Users',
				'name'     => 'Create Users',
				'code'     => 'manage_users_create',
			],
			[
				'category' => 'Users',
				'name'     => 'View Users',
				'code'     => 'manage_users_show',
			],
			[
				'category' => 'Users',
				'name'     => 'Edit Users',
				'code'     => 'manage_users_edit',
			],
			// Categories
			[
				'category' => 'Categories',
				'name'     => 'List Categories',
				'code'     => 'manage_categories_index',
			],
			[
				'category' => 'Categories',
				'name'     => 'Create Categories',
				'code'     => 'manage_categories_create',
			],
			[
				'category' => 'Categories',
				'name'     => 'View Categories',
				'code'     => 'manage_categories_show',
			],
			[
				'category' => 'Categories',
				'name'     => 'Edit Categories',
				'code'     => 'manage_categories_edit',
			],
			[
				'category' => 'Categories',
				'name'     => 'Delete Categories',
				'code'     => 'manage_categories_delete',
			],
			// Statuses
			[
				'category' => 'Statuses',
				'name'     => 'List Statuses',
				'code'     => 'manage_statuses_index',
			],
			[
				'category' => 'Statuses',
				'name'     => 'Create Statuses',
				'code'     => 'manage_statuses_create',
			],
			[
				'category' => 'Statuses',
				'name'     => 'View Statuses',
				'code'     => 'manage_statuses_show',
			],
			[
				'category' => 'Statuses',
				'name'     => 'Edit Statuses',
				'code'     => 'manage_statuses_edit',
			],
			[
				'category' => 'Statuses',
				'name'     => 'Delete Statuses',
				'code'     => 'manage_statuses_delete',
			],
			// Priorities
			[
				'category' => 'Priorities',
				'name'     => 'List Priorities',
				'code'     => 'manage_priorities_index',
			],
			[
				'category' => 'Priorities',
				'name'     => 'Create Priorities',
				'code'     => 'manage_priorities_create',
			],
			[
				'category' => 'Priorities',
				'name'     => 'View Priorities',
				'code'     => 'manage_priorities_show',
			],
			[
				'category' => 'Priorities',
				'name'     => 'Edit Priorities',
				'code'     => 'manage_priorities_edit',
			],
			[
				'category' => 'Priorities',
				'name'     => 'Delete Priorities',
				'code'     => 'manage_priorities_delete',
			],
			// Roles
			[
				'category' => 'Roles & Permissions',
				'name'     => 'List Roles & Permissions',
				'code'     => 'manage_roles_index',
			],
			[
				'category' => 'Roles & Permissions',
				'name'     => 'Create Roles & Permissions',
				'code'     => 'manage_roles_create',
			],
			[
				'category' => 'Roles & Permissions',
				'name'     => 'View Roles & Permissions',
				'code'     => 'manage_roles_show',
			],
			[
				'category' => 'Roles & Permissions',
				'name'     => 'Edit Roles & Permissions',
				'code'     => 'manage_roles_edit',
			],
			[
				'category' => 'Roles & Permissions',
				'name'     => 'Delete Roles & Permissions',
				'code'     => 'manage_roles_delete',
			],
		];

		foreach ($permissions as $permission) {
			$new_permission = new Permission();
			$new_permission->category = $permission['category'];
			$new_permission->name = $permission['name'];
			$new_permission->code = $permission['code'];
			$new_permission->save();
		}

	}

}
