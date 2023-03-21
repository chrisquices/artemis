<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$priorities = [
			[
				"name"  => 'Low',
				"color" => '#064e3b',
			],
			[
				"name"  => 'Medium',
				"color" => '#facc15',
			],
			[
				"name"  => 'High',
				"color" => '#e11d47',
			],
			[
				"name"  => 'Emergency',
				"color" => '#e11d47',
			],
		];

		foreach ($priorities as $priority) {
			$new_priority = new Priority();
			$new_priority->name = $priority['name'];
			$new_priority->color = $priority['color'];
			$new_priority->is_active = 1;
			$new_priority->save();
		}

	}

}
