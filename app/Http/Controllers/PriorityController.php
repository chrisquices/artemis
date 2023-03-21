<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PriorityController extends Controller {

	public function index()
	{
		return view('priorities.index');
	}

	public function create()
	{
		return view('priorities.create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'      => 'required|max:255',
			'color'     => 'required|max:255',
			'is_active' => 'required|max:255',
		])->validate();

		$priority = new Priority();
		$priority->name = $request->name;
		$priority->color = $request->color;
		$priority->is_active = $request->is_active;
		$priority->save();

		Session::flash('success', 'New priority created successfully!');

		return redirect()->route('priorities.show', ['priority' => $priority->id]);
	}

	public function show(Priority $priority)
	{
		return view('priorities.show', compact('priority'));
	}

	public function edit(Priority $priority)
	{
		return view('priorities.edit', compact('priority'));
	}

	public function update(Request $request, Priority $priority)
	{
		$validator = Validator::make($request->all(), [
			'name'      => 'required|max:255',
			'color'     => 'required|max:255',
			'is_active' => 'required|max:255',
		])->validate();

		$priority->name = $request->name;
		$priority->color = $request->color;
		$priority->is_active = $request->is_active;
		$priority->save();

		Session::flash('success', 'Priority updated successfully!');

		return redirect()->route('priorities.show', ['priority' => $priority->id]);
	}

	public function delete(Priority $priority)
	{
		try {
			$priority->delete();

			Session::flash('success', 'Priority deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Priority was not deleted');
		}

		return redirect()->route('priorities.index');
	}

}
