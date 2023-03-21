<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Ticket;
use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 1000; $i++) {
			$ticket = Ticket::find(rand(1, 150));
			$project = $ticket->project;
			$project_users = $project->projectUsers->random();
			$user = $project_users->user;

			$new_note = new Note();
			$new_note->ticket_id = $ticket->id;
			$new_note->content = fake()->realText(rand(50, 250));
			$new_note->user_id = $user->id;
			$new_note->is_reporter = ($ticket->reported_by_user_id == $user->id) ? 1 : 0;
			$new_note->is_assigned = ($ticket->assigned_to_user_id == $user->id) ? 1 : 0;
			$new_note->is_supervisor = ($project_users->is_supervisor) ? 1 : 0;
			$new_note->submitted_at = now();
			$new_note->save();
		}

	}

}

