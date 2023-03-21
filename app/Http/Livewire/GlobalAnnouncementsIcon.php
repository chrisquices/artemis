<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\AnnouncementUser;
use Livewire\Component;

class GlobalAnnouncementsIcon extends Component {

	public $user;
	public $unread_announcements;

	public function mount()
	{
		$this->user = auth()->user();
	}

	public function render()
	{
		$announcement_ids = AnnouncementUser::query()
			->where('user_id', $this->user->id)
			->where('is_dismissed', 0)
			->pluck('announcement_id');

		$this->unread_announcements = Announcement::query()
			->where('is_active', 1)
			->whereIn('id', $announcement_ids)
			->orderByDesc('submitted_at')
			->get();

		return view('livewire.global-announcements-icon');
	}

}
