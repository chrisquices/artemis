<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PermissionChecker {

	/**
	 * Handle an incoming request.
	 *
	 * @param Request                                       $request
	 * @param Closure(Request): (Response|RedirectResponse) $next
	 * @return Response|RedirectResponse
	 */
	public function handle(Request $request, Closure $next, $permission_code)
	{
		$has_permission = \App\Classes\PermissionChecker::instance()->hasPermission($permission_code);

		if ($has_permission) {
			return $next($request);
		}

		Session::flash('error', 'Access denied');

		return redirect()->route('dashboard.index');
	}

}
