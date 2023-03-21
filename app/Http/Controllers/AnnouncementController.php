<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller {

	public function index()
	{
		return view('announcements.index');
	}

	public function create()
	{
		return view('announcements.create');
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title'        => 'required|max:255',
			'message'      => 'required|max:500',
			'is_active'    => 'required|max:255',
			'submitted_at' => 'required|max:255',
		])->validate();

		$announcement = new Announcement();
		$announcement->user_id = auth()->user()->id;
		$announcement->title = $request->title;
		$announcement->message = $request->message;
		$announcement->is_active = $request->is_active;
		$announcement->submitted_at = $request->submitted_at;
		$announcement->save();

		$users = User::all();

		foreach ($users as $user) {
			$announcement_user = new AnnouncementUser();
			$announcement_user->announcement_id = $announcement->id;
			$announcement_user->user_id = $user->id;
			$announcement_user->is_dismissed = 0;
			$announcement_user->save();
		}

		Session::flash('success', 'New announcement created successfully!');

		return redirect()->route('announcements.show', ['announcement' => $announcement->id]);
	}

	public function show(Announcement $announcement)
	{
		$announcement_user = AnnouncementUser::query()
			->where('announcement_id', $announcement->id)
			->where('user_id', auth()->user()->id)
			->first();

		$announcement_user->is_dismissed = 1;
		$announcement_user->save();

		return view('announcements.show', compact('announcement'));
	}

	public function edit(Announcement $announcement)
	{
		return view('announcements.edit', compact('announcement'));
	}

	public function update(Request $request, Announcement $announcement)
	{
		$validator = Validator::make($request->all(), [
			'title'        => 'required|max:255',
			'message'      => 'required|max:500',
			'is_active'    => 'required|max:255',
			'submitted_at' => 'required|max:255',
		])->validate();

		$announcement->title = $request->title;
		$announcement->message = $request->message;
		$announcement->is_active = $request->is_active;
		$announcement->submitted_at = $request->submitted_at;
		$announcement->save();

		foreach ($announcement->announcementUsers as $announcement_user) {
			$announcement_user->is_dismissed = 0;
			$announcement_user->save();
		}

		Session::flash('success', 'Announcement updated successfully!');

		return redirect()->route('announcements.show', ['announcement' => $announcement->id]);
	}

	public function delete(Announcement $announcement)
	{
		try {
			$announcement->delete();

			Session::flash('success', 'Announcement deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Announcement was not deleted');
		}

		return redirect()->route('announcements.index');
	}

}
