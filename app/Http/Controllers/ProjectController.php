<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller {

	public function index()
	{
		return view('projects.index');
	}

	public function create()
	{
		$statuses = Status::where('type', 'Project')->get();

		return view('projects.create', compact('statuses'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'status_id'   => 'required|max:255',
			'name'        => 'required|max:255',
			'description' => 'required|max:255',
			'started_at'  => 'required|max:255',
		])->validate();

		$project = new Project();
		$project->status_id = $request->status_id;
		$project->name = $request->name;
		$project->description = $request->description;
		$project->started_at = $request->started_at;

		if ($request->photo) {
			$validator = Validator::make($request->all(), [
				'photo' => 'mimes:jpg,jpeg',
			])->validate();

			$image_name = substr(str_shuffle(md5(time())), 0, 10) . '.jpg';

			Storage::disk('public')->putFileAs('projects/', $request->file('photo'), $image_name);

			Image::make(public_path('storage/projects/' . $image_name))
				->resize(1000, 1000)
				->save();

			$project->photo = 'projects/' . $image_name;
		}

		$project->save();

		Session::flash('success', 'New project created successfully!');

		return redirect()->route('projects.show', ['project' => $project->id]);
	}

	public function show(Project $project)
	{
		return view('projects.show', compact('project'));
	}

	public function edit(Project $project)
	{
		$statuses = Status::where('type', 'Project')->get();

		return view('projects.edit', compact('project', 'statuses'));
	}

	public function update(Request $request, Project $project)
	{
		$validator = Validator::make($request->all(), [
			'status_id'   => 'required|max:255',
			'name'        => 'required|max:255',
			'description' => 'required|max:255',
			'started_at'  => 'required|max:255',
		])->validate();

		$project->status_id = $request->status_id;
		$project->name = $request->name;
		$project->description = $request->description;
		$project->started_at = $request->started_at;

		if ($request->photo) {
			$validator = Validator::make($request->all(), [
				'photo' => 'mimes:jpg,jpeg',
			])->validate();

			$image_name = substr(str_shuffle(md5(time())), 0, 10) . '.jpg';

			Storage::disk('public')->putFileAs('projects/', $request->file('photo'), $image_name);

			Image::make(public_path('storage/projects/' . $image_name))
				->resize(1000, 1000)
				->save();

			$project->photo = 'projects/' . $image_name;
		}

		$project->save();

		Session::flash('success', 'Project updated successfully!');

		return redirect()->route('projects.show', ['project' => $project->id]);
	}

	public function delete(Project $project)
	{
		if ($project->projectUsers->count() > 0) {
			Session::flash('error', 'Please remove all members first');

			return back();
		}

		if ($project->tickets->count() > 0) {
			Session::flash('error', 'Please delete all tickets first');

			return back();
		}

		try {
			$project->delete();

			Session::flash('success', 'Project deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Project was not deleted');
		}

		return redirect()->route('projects.index');
	}

}
