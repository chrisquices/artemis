<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TicketsIndex extends Component {

	use WithPagination;

	public $projects;
	public $categories;
	public $statuses;
	public $priorities;
	public $reporter_users;
	public $assigned_users;

	public $show;
	public $view_type;
	public $search_term;

	public $selected_project_id;
	public $selected_category_id;
	public $selected_status_id;
	public $selected_priority_id;
	public $selected_reported_by_user_id;
	public $selected_assigned_to_user_id;
	public $selected_submitted_at_from;
	public $selected_submitted_at_to;


	public function mount()
	{
		$user = auth()->user();

		$this->show = session('global_show') ?? '12';
		$this->view_type = session('global_view_type') ?? 'grid'; // grid or table

		if ($user->type == 'Administrator') {
			$this->projects = Project::all();
		} else {
			$available_project_ids = ProjectUser::where('user_id', $user->id)->pluck('project_id');
			$this->projects = Project::find($available_project_ids);
		}

		$project_user_ids = ProjectUser::whereIn('project_id', $this->projects->pluck('id'))->pluck('user_id');

		$this->reporter_users = User::find($project_user_ids);
		$this->assigned_users = User::find($project_user_ids);

		$this->categories = Category::all();
		$this->statuses = Status::where('type', 'Ticket')->get();
		$this->priorities = Priority::all();
	}

	public function render()
	{
		$tickets_query = Ticket::query();

		if ($this->search_term) $tickets_query->where('summary', 'like', '%' . $this->search_term . '%');
		if ($this->selected_project_id) $tickets_query->where('project_id', $this->selected_project_id);
		if ($this->selected_category_id) $tickets_query->where('category_id', $this->selected_category_id);
		if ($this->selected_status_id) $tickets_query->where('status_id', $this->selected_status_id);
		if ($this->selected_priority_id) $tickets_query->where('priority_id', $this->selected_priority_id);
		if ($this->selected_reported_by_user_id) $tickets_query->where('reported_by_user_id', $this->selected_reported_by_user_id);
		if ($this->selected_assigned_to_user_id) $tickets_query->where('assigned_to_user_id', $this->selected_assigned_to_user_id);
		if ($this->selected_submitted_at_from) $tickets_query->where('submitted_at', '>=', $this->selected_submitted_at_from);
		if ($this->selected_submitted_at_to) $tickets_query->where('submitted_at', '<=', $this->selected_submitted_at_to);

		$tickets = $tickets_query->whereIn('project_id', $this->projects->pluck('id'))->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.tickets-index', [
			'tickets' => $tickets,
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
