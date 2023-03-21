<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component {

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
		$users_query = User::query();

		if ($this->search_term) {
			$users_query->where('name', 'like', '%' . $this->search_term . '%');
			$users_query->where('name', 'like', '%' . $this->search_term . '%');
		}

		$users = $users_query->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.users-index', [
			'users' => $users,
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
