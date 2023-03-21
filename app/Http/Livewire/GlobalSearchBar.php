<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Ticket;
use Livewire\Component;

class GlobalSearchBar extends Component {

	public $user;
	public $projects;
	public $tickets;

	public $search_term;

	public function mount()
	{
		$this->user = auth()->user();
	}

	public function render()
	{
		if ($this->user->type == 'Administrator') {
			$available_project_ids = Project::all()->pluck('id');
		} else {
			$available_project_ids = ProjectUser::where('user_id', $this->user->id)->pluck('project_id');
		}

		if ($this->search_term) {
			$this->projects = Project::query()
				->whereIn('id', $available_project_ids)
				->where('name', 'like', '%' . $this->search_term . '%')->get()->take(5);

			$this->tickets = Ticket::query()
				->whereIn('project_id', $this->projects->pluck('id'))
				->where('summary', 'like', '%' . $this->search_term . '%')
				->orderByDesc('submitted_at')
				->get()
				->take(5);

		} else {
			$this->projects = [];
			$this->tickets = [];
		}

		return view('livewire.global-search-bar');
	}

}
