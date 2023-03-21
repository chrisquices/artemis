<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Ticket;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class TicketController extends Controller {

	public function index()
	{
		return view('tickets.index');
	}

	public function create()
	{
		return view('tickets.create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'project_id'          => 'required|max:255',
			'category_id'         => 'required|max:255',
			'priority_id'         => 'required|max:255',
			'status_id'           => 'required|max:255',
			'reported_by_user_id' => 'required|max:255',
			'summary'             => 'required|max:255',
			'description'         => 'required|max:2048',
			'submitted_at'        => 'required|max:255',
		])->validate();

		$ticket = new Ticket();
		$ticket->project_id = $request->project_id;
		$ticket->category_id = $request->category_id;
		$ticket->priority_id = $request->priority_id;
		$ticket->status_id = $request->status_id;
		$ticket->reported_by_user_id = $request->reported_by_user_id;
		$ticket->assigned_to_user_id = $request->assigned_to_user_id;
		$ticket->summary = $request->summary;
		$ticket->description = $request->description;
		$ticket->tags = $request->tags;
		$ticket->submitted_at = $request->submitted_at;
		$ticket->save();

		Session::flash('success', 'New ticket created successfully!');

		return redirect()->route('tickets.show', ['ticket' => $ticket->id]);
	}

	public function show(Ticket $ticket)
	{
		return view('tickets.show', compact('ticket'));
	}

	public function edit(Ticket $ticket)
	{
		$project_user_ids = ProjectUser::where('project_id', $ticket->project->id)->pluck('user_id');

		$statuses = Status::where('type', 'Ticket')->get();
		$categories = Category::all();
		$priorities = Priority::all();
		$reporter_users = User::find($project_user_ids);
		$assigned_users = User::find($project_user_ids);

		return view('tickets.edit', compact('ticket', 'statuses', 'categories', 'priorities', 'reporter_users', 'assigned_users'));
	}

	public function update(Request $request, Ticket $ticket)
	{
		$validator = Validator::make($request->all(), [
			'category_id'         => 'required|max:255',
			'priority_id'         => 'required|max:255',
			'status_id'           => 'required|max:255',
			'reported_by_user_id' => 'required|max:255',
			'summary'             => 'required|max:255',
			'description'         => 'required|max:2048',
			'submitted_at'        => 'required|max:255',
		])->validate();

		$ticket->category_id = $request->category_id;
		$ticket->priority_id = $request->priority_id;
		$ticket->status_id = $request->status_id;
		$ticket->reported_by_user_id = $request->reported_by_user_id;
		$ticket->assigned_to_user_id = $request->assigned_to_user_id;
		$ticket->summary = $request->summary;
		$ticket->description = $request->description;
		$ticket->tags = $request->tags;
		$ticket->submitted_at = $request->submitted_at;
		$ticket->save();

		Session::flash('success', 'Ticket updated successfully!');

		return redirect()->route('tickets.show', ['ticket' => $ticket->id]);
	}

	public function delete(Ticket $ticket)
	{
		try {
			$ticket->delete();

			Session::flash('success', 'Ticket deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Ticket was not deleted');
		}

		return redirect()->route('tickets.index');
	}

}
