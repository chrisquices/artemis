<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

	public function index()
	{
		return view('categories.index');
	}

	public function create()
	{
		return view('categories.create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'      => 'required|max:255',
			'is_active' => 'required|max:255',
		])->validate();

		$category = new Category();
		$category->name = $request->name;
		$category->is_active = $request->is_active;
		$category->save();

		Session::flash('success', 'New category created successfully!');

		return redirect()->route('categories.show', ['category' => $category->id]);
	}

	public function show(Category $category)
	{
		return view('categories.show', compact('category'));
	}

	public function edit(Category $category)
	{
		return view('categories.edit', compact('category'));
	}

	public function update(Request $request, Category $category)
	{
		$validator = Validator::make($request->all(), [
			'name'      => 'required|max:255',
			'is_active' => 'required|max:255',
		])->validate();

		$category->name = $request->name;
		$category->is_active = $request->is_active;
		$category->save();

		Session::flash('success', 'Category updated successfully!');

		return redirect()->route('categories.show', ['category' => $category->id]);
	}

	public function delete(Category $category)
	{
		try {
			$category->delete();

			Session::flash('success', 'Category deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Category was not deleted');
		}

		return redirect()->route('categories.index');
	}

}
