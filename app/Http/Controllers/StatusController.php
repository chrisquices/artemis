<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller {

	public function index()
	{
		return view('statuses.index');
	}

	public function create()
	{
		return view('statuses.create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'type'      => 'required|max:255',
			'name'      => 'required|max:255',
			'color'     => 'required|max:255',
			'is_active' => 'required|max:255',
		])->validate();

		$status = new Status();
		$status->type = $request->type;
		$status->name = $request->name;
		$status->color = $request->color;
		$status->is_active = $request->is_active;
		$status->save();

		Session::flash('success', 'New status created successfully!');

		return redirect()->route('statuses.show', ['status' => $status->id]);
	}

	public function show(Status $status)
	{
		return view('statuses.show', compact('status'));
	}

	public function edit(Status $status)
	{
		return view('statuses.edit', compact('status'));
	}

	public function update(Request $request, Status $status)
	{
		$validator = Validator::make($request->all(), [
			'type'      => 'required|max:255',
			'name'      => 'required|max:255',
			'color'     => 'required|max:255',
			'is_active' => 'required|max:255',
		])->validate();

		$status->type = $request->type;
		$status->name = $request->name;
		$status->color = $request->color;
		$status->is_active = $request->is_active;
		$status->save();

		Session::flash('success', 'Status updated successfully!');

		return redirect()->route('statuses.show', ['status' => $status->id]);
	}

	public function delete(Status $status)
	{
		try {
			$status->delete();

			Session::flash('success', 'Status deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Status was not deleted');
		}

		return redirect()->route('statuses.index');
	}

}
