<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory()->create([
			'type'      => 'Administrator',
			'name'      => 'Admin Artemis',
			'email'     => 'admin@artemis.com',
			'photo'     => 'users/user-00020.png',
			'is_active' => 1,
		]);

		User::factory()->create([
			'type'      => 'User',
			'name'      => 'Demo Engineer',
			'email'     => 'demoengineer@artemis.com',
			'photo'     => 'users/user-00020.png',
			'is_active' => 1,
		]);

		User::factory(99)->create();

		$users = User::query()
			->where('id', '!=', 2)
			->where('type', 'User')
			->get();

		foreach ($users as $user) {
			$possible_role_ids = [1, 2, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4];

			$new_role_user = new RoleUser();
			$new_role_user->role_id = fake()->randomElement($possible_role_ids);
			$new_role_user->user_id = $user->id;
			$new_role_user->save();
		}

		$new_role_user = new RoleUser();
		$new_role_user->role_id = 3;
		$new_role_user->user_id = 2;
		$new_role_user->save();
	}

}
