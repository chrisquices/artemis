<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$statuses = [
			[
				"type"  => 'Project',
				"name"  => 'Active',
				"color" => '#064e3b',
			],
			[
				"type"  => 'Project',
				"name"  => 'Completed',
				"color" => '#064e3b',
			],
			[
				"type"  => 'Project',
				"name"  => 'Cancelled',
				"color" => '#64748b',
			],
			[
				"type"  => 'Ticket',
				"name"  => 'Open',
				"color" => '#06b5d4',
			],
			[
				"type"  => 'Ticket',
				"name"  => 'Assigned',
				"color" => '#064e3b',
			],
			[
				"type"  => 'Ticket',
				"name"  => 'Resolved',
				"color" => '#064e3b',
			],
			[
				"type"  => 'Ticket',
				"name"  => 'Cancelled',
				"color" => '#64748b',
			],
		];

		foreach ($statuses as $status) {
			$new_status = new Status();
			$new_status->type = $status['type'];
			$new_status->name = $status['name'];
			$new_status->color = $status['color'];
			$new_status->is_active = 1;
			$new_status->save();
		}
	}

}
