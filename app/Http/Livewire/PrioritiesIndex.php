<?php

namespace App\Http\Livewire;

use App\Models\Priority;
use Livewire\Component;
use Livewire\WithPagination;

class PrioritiesIndex extends Component {

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
		$priorities_query = Priority::query();

		if ($this->search_term) {
			$priorities_query->where('name', 'like', '%' . $this->search_term . '%');
			$priorities_query->where('name', 'like', '%' . $this->search_term . '%');
		}

		$priorities = $priorities_query->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.priorities-index', [
			'priorities' => $priorities,
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
