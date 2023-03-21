<?php

namespace App\Classes;

use App\Models\Permission;
use App\Models\PermissionRole;

class PermissionChecker {

	public function hasPermission($permission)
	{
		if (auth()->user()->type == 'Administrator') return true;

		$permissions_available = Permission::find(PermissionRole::query()
			->whereIn('role_id', auth()->user()->roleUsers->pluck('role_id'))
			->get()
			->unique('permission_id')
			->pluck('permission_id')
		);

		if (is_array($permission)) {
			return (bool)$permissions_available->whereIn('code', $permission)->first();
		}

		return (bool)$permissions_available->where('code', $permission)->first();
	}

	public static function instance()
	{
		return new PermissionChecker();
	}

}
