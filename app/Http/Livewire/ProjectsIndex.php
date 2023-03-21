<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectUser;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsIndex extends Component {

	use WithPagination;

	public $user;
	public $show;
	public $view_type;
	public $search_term;

	public function mount()
	{
		$this->user = auth()->user();
		$this->show = session('global_show') ?? '12';
		$this->view_type = session('global_view_type') ?? 'grid'; // grid or table
	}

	public function render()
	{
		$projects_query = Project::query();

		if ($this->user->type == 'User') {
			$my_project_ids = ProjectUser::where('user_id', $this->user->id)->pluck('project_id');

			$projects_query->whereIn('id', $my_project_ids);
		}

		if ($this->search_term) {
			$projects_query->where('name', 'like', '%' . $this->search_term . '%');
		}

		$projects = $projects_query->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.projects-index', [
			'projects' => $projects,
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
