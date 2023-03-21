<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SettingsIndex extends Component {

	public $categories;
	public $statuses;
	public $priorities;
	public $active_menu;

	public $name;

	public function mount()
	{
		$this->active_menu = 'categories';
	}

	public function render()
	{
		$this->categories = Category::all();
		$this->statuses = Status::all();
		$this->priorities = Priority::all();

		return view('livewire.settings-index');
	}

	public function updateActiveMenu($menu)
	{
		$this->active_menu = $menu;
	}

	public function storeCategory()
	{
		$new_category = new Category();
		$new_category->name = $this->name;
		$new_category->save();
	}

	public function toggleCategory($category)
	{
		$category = Category::find($category);
		$category->is_active = ($category->is_active) ? 0 : 1;
		$category->save();
	}

}
