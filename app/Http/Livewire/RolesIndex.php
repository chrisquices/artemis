<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RolesIndex extends Component {

	use WithPagination;

	public $show;
	public $view_type;
	public $search_term;

	public function mount()
	{
		$this->show = session('global_show') ?? '12';
		$this->view_type = session('global_view_type') ?? 'grid'; // grid or table
	}

	public function render()
	{
		$roles_query = Role::query();

		if ($this->search_term) {
			$roles_query->where('name', 'like', '%' . $this->search_term . '%');
		}

		$roles = $roles_query->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.roles-index', [
			'roles' => $roles,
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
