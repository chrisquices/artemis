<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller {

	public function index()
	{
		return view('users.index');
	}

	public function create()
	{
		$roles = Role::all();

		return view('users.create', compact('roles'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'type'     => 'required|max:255',
			'name'     => 'required|max:255',
			'email'    => 'required|email|unique:users',
			'password' => 'required|confirmed',
		])->validate();

		$user = new User();
		$user->type = $request->type;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->email_verified_at = now();
		$user->password = Hash::make($request->password);
		$user->is_active = $request->is_active;
		$user->save();

		if ($request->photo) {
			$validator = Validator::make($request->all(), [
				'photo' => 'mimes:jpg,jpeg',
			])->validate();

			$image_name = substr(str_shuffle(md5(time())), 0, 10) . '.jpg';

			Storage::disk('public')->putFileAs('users/', $request->file('photo'), $image_name);

			Image::make(public_path('storage/users/' . $image_name))
				->resize(1000, 1000)
				->encode('jpg', 70)
				->save();

			$user->photo = 'users/' . $image_name;
			$user->save();
		}

		foreach ($request->role_ids as $role_id) {
			$role_user = new RoleUser();
			$role_user->role_id = $role_id;
			$role_user->user_id = $user->id;
			$role_user->save();
		}

		Session::flash('success', 'New user created successfully!');

		return redirect()->route('users.show', ['user' => $user->id]);
	}

	public function show(User $user)
	{
		$roles = Role::all();

		return view('users.show', compact('user', 'roles'));
	}

	public function edit(User $user)
	{
		$roles = Role::all();

		return view('users.edit', compact('user', 'roles'));
	}

	public function update(Request $request, User $user)
	{
		$validator = Validator::make($request->all(), [
			'type'     => 'required|max:255',
			'name'     => 'required|max:255',
			'email'    => 'required|max:255|email|' . Rule::unique('users')->ignore($user->id),
			'password' => 'confirmed',
		])->validate();

		$user->type = $request->type;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->is_active = $request->is_active;
		$user->save();

		if ($request->password || $request->password_confirmation && $request->password == $request->password_confirmation) {
			$user->password = Hash::make($request->password);
			$user->save();
		}

		if ($request->photo) {
			$validator = Validator::make($request->all(), [
				'photo' => 'mimes:jpg,jpeg',
			])->validate();

			$image_name = substr(str_shuffle(md5(time())), 0, 10) . '.jpg';

			Storage::disk('public')->putFileAs('users/', $request->file('photo'), $image_name);

			Image::make(public_path('storage/users/' . $image_name))
				->resize(1000, 1000)
				->encode('jpg', 70)
				->save();

			$user->photo = 'users/' . $image_name;
			$user->save();
		}

		foreach ($user->roleUsers as $role_user) {
			$role_user->delete();
		}

		if ($request->role_ids) {
			foreach ($request->role_ids as $role_id) {
				$role_user = new RoleUser();
				$role_user->role_id = $role_id;
				$role_user->user_id = $user->id;
				$role_user->save();
			}
		}

		Session::flash('success', 'User updated successfully!');

		return redirect()->route('users.show', ['user' => $user->id]);
	}

}
