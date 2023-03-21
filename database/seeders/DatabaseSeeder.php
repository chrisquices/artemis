<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\Note;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(PermissionSeeder::class);
		$this->call(RoleSeeder::class);
		$this->call(UserSeeder::class);
		$this->call(CategorySeeder::class);
		$this->call(PrioritySeeder::class);
		$this->call(StatusSeeder::class);
		$this->call(ProjectSeeder::class);
		$this->call(ProjectUserSeeder::class);
		$this->call(TicketSeeder::class);
		$this->call(NoteSeeder::class);
		$this->call(AnnouncementSeeder::class);
	}

}
