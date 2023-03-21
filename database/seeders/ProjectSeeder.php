<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$projects = [
			[
				"status_id"   => 1,
				"name"        => 'Caerus',
				"description" => 'Caerus is a free service to job seekers, where you can upload a resume, search for jobs, save them and apply to them directly. Employers may also keep track of their candidates and maintain a history of the interview progress.',
				"photo"       => 'projects/caerus.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'Hermes',
				"description" => 'Hermes is a free instant messaging app available on the web. It allows you to send text messages to other users one-on-one.',
				"photo"       => 'projects/hermes.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'SiSr',
				"description" => 'SiSr is a web app that allows you to order your food at your favorite restaurant without the need of interacting with the waiters, simply choose your grub, confirm and await!',
				"photo"       => 'projects/sisr.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'Agora',
				"description" => 'An online marketplace where you can buy and sell anything, anywhere at anytime!',
				"photo"       => 'projects/agora.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'Artemis',
				"description" => 'A bug tracking software meant for software development companies',
				"photo"       => 'projects/artemis.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'Aletheia',
				"description" => 'No information provided',
				"photo"       => 'projects/aletheia.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'UI Basa Capital',
				"description" => 'The static version of the website of Basa Capital (https://portalweb.basacapital.com.py)',
				"photo"       => 'projects/ui-basa-capital.png',
			],
			[
				"status_id"   => 1,
				"name"        => 'UI Raices',
				"description" => 'The static version of the website of Raices (https://usuarios.raices.com.py/login)',
				"photo"       => 'projects/ui-raices.png',
			],
			//												[
			//																"status_id"   => 1,
			//																"name"        => 'Merkto',
			//																"description" => 'A business-to-business (B2B) ecommerce, purchase goods from anywhere in Paraguay!',
			//																"photo"       => 'projects/merkto.png',
			//												],
			//												[
			//																"status_id"   => 1,
			//																"name"        => 'Gymmer',
			//																"description" => 'Manage your customers data such as routines, schedules, muscle priorities, monthly payments/installments and more!',
			//																"photo"       => 'projects/gymmer.png',
			//												],
			//												[
			//																"status_id"   => 1,
			//																"name"        => 'Matse',
			//																"description" => 'Software meant to manage all the real estate properties of Matse S.A.',
			//																"photo"       => 'projects/matse.png',
			//												],
		];

		foreach ($projects as $project) {
			$new_project = new Project();
			$new_project->status_id = $project['status_id'];
			$new_project->name = $project['name'];
			$new_project->description = $project['description'];
			$new_project->photo = $project['photo'];
			$new_project->name = $project['name'];
			$new_project->started_at = now()->subDays(rand(30, 120));
			$new_project->save();
		}

	}

}
