<?php

namespace Database\Seeders;

use App\Models\ProjectUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$project_users = [
			// Project 1
			[
				"project_id"    => 1,
				"user_id"       => 4,
				"is_supervisor" => 0,
			],
			[
				"project_id"    => 1,
				"user_id"       => 9,
				"is_supervisor" => 0,
			],
			[
				"project_id"    => 1,
				"user_id"       => 8,
				"is_supervisor" => 1,
			],
			// Project 2
			[
				"project_id"    => 2,
				"user_id"       => 6,
				"is_supervisor" => 0,
			],
			[
				"project_id"    => 2,
				"user_id"       => 2,
				"is_supervisor" => 1,
			],
			[
				"project_id"    => 2,
				"user_id"       => 3,
				"is_supervisor" => 0,
			],
			// Project 3
			[
				"project_id"    => 3,
				"user_id"       => 3,
				"is_supervisor" => 0,
			],
			[
				"project_id"    => 3,
				"user_id"       => 8,
				"is_supervisor" => 1,
			],
			[
				"project_id"    => 3,
				"user_id"       => 7,
				"is_supervisor" => 0,
			],
			// Project 4
			[
				"project_id"    => 4,
				"user_id"       => 9,
				"is_supervisor" => 1,
			],
			[
				"project_id"    => 4,
				"user_id"       => 5,
				"is_supervisor" => 0,
			],
			// Project 5
			[
				"project_id"    => 5,
				"user_id"       => 7,
				"is_supervisor" => 1,
			],
			[
				"project_id"    => 5,
				"user_id"       => 3,
				"is_supervisor" => 0,
			],
		];

		foreach ($project_users as $project_user) {
			$new_project = new ProjectUser();
			$new_project->project_id = $project_user['project_id'];
			$new_project->user_id = $project_user['user_id'];
			$new_project->is_supervisor = $project_user['is_supervisor'];
			$new_project->save();
		}

	}

}
