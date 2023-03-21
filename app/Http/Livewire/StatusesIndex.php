<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class StatusesIndex extends Component {

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
		$statuses_query = Status::query();

		if ($this->search_term) {
			$statuses_query->where('name', 'like', '%' . $this->search_term . '%');
		}

		$statuses = $statuses_query->paginate($this->show);

		$this->dispatchBrowserEvent('reloadDataTable');

		return view('livewire.statuses-index', [
			'statuses' => $statuses,
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
