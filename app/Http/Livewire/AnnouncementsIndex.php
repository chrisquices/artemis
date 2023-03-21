<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\AnnouncementUser;
use Livewire\Component;
use Livewire\WithPagination;

class AnnouncementsIndex extends Component {

	use WithPagination;

	public $show;
	public $view_type;
	public $search_term;

	public function mount()
	{
		$this->show = session('global_show') ?? '12';
		$this->view_type = 'table'; // grid or table
	}

	public function render()
	{
		$available_announcement_ids = AnnouncementUser::where('user_id', auth()->user()->id)->pluck('announcement_id');

		$announcements_query = Announcement::query();

		$announcements_query->whereIn('id', $available_announcement_ids);

		if ($this->search_term) {
			$announcements_query->where('title', 'like', '%' . $this->search_term . '%');
		}

		$announcements = $announcements_query->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.announcements-index', [
			'announcements' => $announcements,
		]);
	}

	public function updatingSearch()
	{
		$this->resetPage();
	}

	public function changeShow()
	{
		session()->put('global_show', $this->show);
		$this->resetPage();
	}

	public function changeViewType()
	{
		session()->put('global_view_type', $this->view_type);
		$this->resetPage();
	}

}
