<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$tags = [
			'admin', 'admincheck', 'adodb', 'api', 'attachment', 'attachments', 'authentication', 'avatar', 'bbcode', 'billing',
			'bitbucket', 'blank screen', 'bts_link', 'buttons', 'call_for_testing', 'categories', 'close_me', 'columns', 'csp',
			'custom', 'custom fields', 'date', 'dates', 'download', 'due_date', 'email', 'enum', 'error', 'evil', 'excel', 'exchange',
			'faq', 'feature', 'feed', 'filter', 'fts', 'graphs', 'group', 'hg', 'HIPAA', 'html', 'HTMLmail', 'https', 'ical', 'icon',
			'iis', 'InnoDB', 'install', 'Internet Explorer', 'issue', 'ITIL', 'Launchpad', 'layout', 'LDAP', 'List', 'localization',
			'manage_config_email', 'mantishub', 'mantistouch', 'mercurial', 'mockup', 'modern-ui', 'mssql', 'MySQL', 'news', 'notes',
			'oracle', 'passwords', 'patch', 'PHP 7', 'PHP 7.4', 'PHP 8', 'PHP 8.1', 'PHP 8.2', 'phpbb3', 'phpmailer', 'plugin',
			'plugin framework', 'plugins', 'port to stable', 'postgresql', 'privacy', 'project_management', 'redesign', 'refactoring',
			'regex', 'reminder', 'reporting', 'resolved', 'schema', 'screenshot', 'scrum', 'security', 'seo', 'sla', 'soap',
			'soap api', 'sourceforge', 'sponsor', 'sponsorship', 'statistics', 'status', 'stick', 'summary', 'template', 'test',
			'TravisCI', 'typo', 'unstick', 'update', 'Upload files', 'upstream', 'url', 'usability', 'usergroups', 'utf8', 'verify',
			'wiki', 'windows',
		];

		for ($i = 0; $i < 150; $i++) {
			$project = Project::find(ProjectUser::all()->pluck('project_id'))->random();

			$tags_formatted = fake()->randomElement($tags) . ', ' . fake()->randomElement($tags) . ', ' . fake()->randomElement($tags) . ', ' . fake()->randomElement($tags) . ', ' . fake()->randomElement($tags);

			$new_ticket = new Ticket();
			$new_ticket->project_id = $project->id;
			$new_ticket->category_id = rand(1, 4);
			$new_ticket->priority_id = rand(1, 4);
			$new_ticket->status_id = rand(4, 7);
			$new_ticket->reported_by_user_id = $project->projectUsers->random()->user->id;
			$new_ticket->assigned_to_user_id = $project->projectUsers->random()->user->id;
			$new_ticket->summary = fake()->text(50);
			$new_ticket->description = fake()->realText(200);
			$new_ticket->tags = $tags_formatted;
			$new_ticket->submitted_at = now();
			$new_ticket->save();
		}

	}

}

