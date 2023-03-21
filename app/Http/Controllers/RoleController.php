<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller {

	public function index()
	{
		return view('roles.index');
	}

	public function create()
	{
		$permission_categories = Permission::all()->groupBy('category');

		return view('roles.create', compact('permission_categories'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name'           => 'required|max:255',
			'permission_ids' => 'required',
		])->validate();

		$role = new Role();
		$role->name = $request->name;
		$role->save();

		foreach ($request->permission_ids as $permission_id) {
			$permission_role = new PermissionRole();
			$permission_role->permission_id = $permission_id;
			$permission_role->role_id = $role->id;
			$permission_role->save();
		}

		Session::flash('success', 'New role created successfully!');

		return redirect()->route('roles.show', ['role' => $role->id]);
	}

	public function show(Role $role)
	{
		$permission_categories = Permission::all()->groupBy('category');

		return view('roles.show', compact('role', 'permission_categories'));
	}

	public function edit(Role $role)
	{
		$permission_categories = Permission::all()->groupBy('category');

		return view('roles.edit', compact('role', 'permission_categories'));
	}

	public function update(Request $request, Role $role)
	{
		$validator = Validator::make($request->all(), [
			'name'           => 'required|max:255',
			'permission_ids' => 'required',
		])->validate();

		$role->name = $request->name;
		$role->save();

		foreach ($role->permissionRoles as $permission_role) {
			$permission_role->delete();
		}

		if ($request->permission_ids) {
			foreach ($request->permission_ids as $permission_id) {
				$permission_role = new PermissionRole();
				$permission_role->permission_id = $permission_id;
				$permission_role->role_id = $role->id;
				$permission_role->save();
			}
		}

		Session::flash('success', 'Role updated successfully!');

		return redirect()->route('roles.show', ['role' => $role->id]);
	}

	public function delete(Role $role)
	{
		try {
			$role->delete();

			Session::flash('success', 'Role deleted successfully!');

		} catch (QueryException $e) {
			Session::flash('error', 'Role was not deleted');
		}

		return redirect()->route('roles.index');
	}

}
