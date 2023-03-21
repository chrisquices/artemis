<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\Note;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Ticket;
use Carbon\Carbon;
use Livewire\Component;

class DashboardIndex extends Component {

	public $user;
	public $latest_notes;
	public $latest_announcements;

	public function mount()
	{
		$this->user = auth()->user();

		if ($this->user->type == 'Administrator') {
			$projects = Project::all();
		} else {
			$projects = Project::find(ProjectUser::where('user_id', $this->user->id)->pluck('project_id'));
		}

		$announcement_ids = AnnouncementUser::query()
			->where('user_id', $this->user->id)
			->where('is_dismissed', 0)
			->pluck('announcement_id');

		$this->latest_announcements = Announcement::query()
			->where('is_active', 1)
			->whereIn('id', $announcement_ids)
			->orderByDesc('submitted_at')
			->get();

		$ticket_ids = Ticket::whereIn('project_id', $projects->pluck('id'))->pluck('id');

		$this->latest_notes = Note::query()
			->whereIn('ticket_id', $ticket_ids)
			->where('submitted_at', '>=', Carbon::now()->subDays(2))
			->orderByDesc('submitted_at')
			->get()
			->take(10);
	}

	public function render()
	{
		return view('livewire.dashboard-index');
	}

	public function dismissAnnouncementUser($announcement_id)
	{
		$announcement_user = AnnouncementUser::query()
			->where('announcement_id', $announcement_id)
			->where('user_id', $this->user->id)
			->first();

		$announcement_user->is_dismissed = 1;
		$announcement_user->save();

		$this->latest_announcements = Announcement::find(AnnouncementUser::query()
			->where('user_id', $this->user->id)
			->where('is_dismissed', 0)
			->pluck('announcement_id'));
	}

}
