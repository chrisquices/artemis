<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::all();

		for ($i = 0; $i < 10; $i++) {
			$new_announcement = new Announcement();
			$new_announcement->user_id = User::find(rand(1, 100))->id;
			$new_announcement->title = fake()->text(rand(15, 30));
			$new_announcement->message = fake()->text(rand(300, 500));
			$new_announcement->submitted_at = now();
			$new_announcement->is_active = 1;
			$new_announcement->save();

			foreach ($users as $user) {
				$new_announcement_user = new AnnouncementUser();
				$new_announcement_user->announcement_id = $new_announcement->id;
				$new_announcement_user->user_id = $user->id;
				$new_announcement_user->is_dismissed = 0;
				$new_announcement_user->save();
			}
		}
	}

}
