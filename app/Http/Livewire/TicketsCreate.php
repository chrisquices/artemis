<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class TicketsCreate extends Component {

	public $projects;
	public $categories;
	public $priorities;
	public $statuses;
	public $reporter_users;
	public $assigned_users;

	public $selected_project_id;

	public function mount()
	{
		$user = auth()->user();

		if ($user->type == 'Administrator') {
			$this->projects = Project::all();
		} else {
			$available_project_ids = ProjectUser::where('user_id', $user->id)->pluck('project_id');
			$this->projects = Project::find($available_project_ids);
		}

		$this->categories = Category::all();
		$this->priorities = Priority::all();
		$this->statuses = Status::where('type', 'Ticket')->get();
		$this->reporter_users = [];
		$this->assigned_users = [];

		$this->selected_project_id = request()->get('project_id');
	}

	public function render()
	{
		if ($this->selected_project_id) {
			$project_user_ids = ProjectUser::where('project_id', $this->selected_project_id)->pluck('user_id');

			$this->reporter_users = User::find($project_user_ids);
			$this->assigned_users = User::find($project_user_ids);
		}

		return view('livewire.tickets-create');
	}

}
