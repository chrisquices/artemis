<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Priority;
use App\Models\ProjectUser;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;

class ProjectsShow extends Component {

	public $project;
	public $tickets;
	public $members;
	public $categories;
	public $statuses;
	public $priorities;
	public $users;
	public $reporter_users;
	public $assigned_users;
	public $active_menu;
	public $search_term;
	public $selected_is_supervisor;
	public $selected_user_id;
	public $selected_category_id;
	public $selected_status_id;
	public $selected_priority_id;
	public $selected_reported_by_user_id;
	public $selected_assigned_to_user_id;
	public $selected_submitted_at_from;
	public $selected_submitted_at_to;

	public function mount($project)
	{
		$this->project = $project;
		$this->categories = Category::all();
		$this->statuses = Status::where('type', 'Ticket')->get();
		$this->priorities = Priority::all();
		$this->reporter_users = User::find($project->tickets->pluck('reported_by_user_id'));
		$this->assigned_users = User::find($project->tickets->pluck('assigned_to_user_id'));
		$this->active_menu = 'project-information';
	}

	public function render()
	{
		$this->members = ProjectUser::where('project_id', $this->project->id)->get();

		$this->users = User::query()
			->where('type', 'User')
			->whereNotIn('id', $this->members->pluck('user_id'))
			->get();

		$tickets_query = Ticket::query();

		if ($this->search_term) $tickets_query->where('summary', 'like', '%' . $this->search_term . '%');
		if ($this->selected_category_id) $tickets_query->where('category_id', $this->selected_category_id);
		if ($this->selected_status_id) $tickets_query->where('status_id', $this->selected_status_id);
		if ($this->selected_priority_id) $tickets_query->where('priority_id', $this->selected_priority_id);
		if ($this->selected_reported_by_user_id) $tickets_query->where('reported_by_user_id', $this->selected_reported_by_user_id);
		if ($this->selected_assigned_to_user_id) $tickets_query->where('assigned_to_user_id', $this->selected_assigned_to_user_id);
		if ($this->selected_submitted_at_from) $tickets_query->where('submitted_at', '>=', $this->selected_submitted_at_from);
		if ($this->selected_submitted_at_to) $tickets_query->where('submitted_at', '<=', $this->selected_submitted_at_to);

		$this->tickets = $tickets_query->where('project_id', $this->project->id)->orderBy('submitted_at')->get();

		return view('livewire.projects-show');
	}

	public function changeActiveMenu($menu)
	{
		$this->active_menu = $menu;
	}

	public function storeProjectUser()
	{
		if ($this->selected_user_id) {
			$new_project_user = new ProjectUser();
			$new_project_user->project_id = $this->project->id;
			$new_project_user->user_id = $this->selected_user_id;
			$new_project_user->is_supervisor = ($this->selected_is_supervisor) ? 1 : 0;
			$new_project_user->save();

			$this->selected_user_id = '';
			$this->selected_is_supervisor = '';

		} else {
			$this->dispatchBrowserEvent('missingProjectUserId');
		}
	}

	public function deleteProjectUser($user_id)
	{
		// Unassigns all tickets from this user relevant to the project
		$tickets_to_unassign = Ticket::query()
			->where('project_id', $this->project->id)
			->where('assigned_to_user_id', $user_id)
			->get();

		foreach ($tickets_to_unassign as $ticket_to_unassign) {
			$ticket_to_unassign->assigned_to_user_id = null;
			$ticket_to_unassign->save();
		}

		$project_user = ProjectUser::query()
			->where('project_id', $this->project->id)
			->where('user_id', $user_id)
			->first();

		$project_user->delete();
	}

}
