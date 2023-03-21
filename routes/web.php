<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\SettingController;

Route::middleware('auth')->group(function () {

	// Dashboard
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

	// Projects
	Route::group(['prefix' => 'projects'], function () {
		Route::get('/', [ProjectController::class, 'index'])->name('projects.index')->middleware('permission.checker:manage_projects_index');
		Route::get('/create', [ProjectController::class, 'create'])->name('projects.create')->middleware('permission.checker:manage_projects_create');
		Route::post('/store', [ProjectController::class, 'store'])->name('projects.store')->middleware('permission.checker:manage_projects_create');
		Route::get('/{project}', [ProjectController::class, 'show'])->name('projects.show')->middleware('permission.checker:manage_projects_show');
		Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit')->middleware('permission.checker:manage_projects_edit');
		Route::patch('/{project}/update', [ProjectController::class, 'update'])->name('projects.update')->middleware('permission.checker:manage_projects_edit');
		Route::delete('/{project}/delete', [ProjectController::class, 'delete'])->name('projects.delete')->middleware('permission.checker:manage_projects_delete');
	});

	// Tickets
	Route::group(['prefix' => 'tickets'], function () {
		Route::get('/', [TicketController::class, 'index'])->name('tickets.index')->middleware('permission.checker:manage_tickets_index');
		Route::get('/create', [TicketController::class, 'create'])->name('tickets.create')->middleware('permission.checker:manage_tickets_create');
		Route::post('/store', [TicketController::class, 'store'])->name('tickets.store')->middleware('permission.checker:manage_tickets_create');
		Route::get('/{ticket}', [TicketController::class, 'show'])->name('tickets.show')->middleware('permission.checker:manage_tickets_show');
		Route::get('/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit')->middleware('permission.checker:manage_tickets_edit');
		Route::patch('/{ticket}/update', [TicketController::class, 'update'])->name('tickets.update')->middleware('permission.checker:manage_tickets_edit');
		Route::delete('/{ticket}/delete', [TicketController::class, 'delete'])->name('tickets.delete')->middleware('permission.checker:manage_tickets_delete');
	});

	// Announcements
	Route::group(['prefix' => 'announcements'], function () {
		Route::get('/', [AnnouncementController::class, 'index'])->name('announcements.index')->middleware('permission.checker:manage_announcements_index');
		Route::get('/create', [AnnouncementController::class, 'create'])->name('announcements.create')->middleware('permission.checker:manage_announcements_create');
		Route::post('/store', [AnnouncementController::class, 'store'])->name('announcements.store')->middleware('permission.checker:manage_announcements_create');
		Route::get('/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show')->middleware('permission.checker:manage_announcements_show');
		Route::get('/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit')->middleware('permission.checker:manage_announcements_edit');
		Route::patch('/{announcement}/update', [AnnouncementController::class, 'update'])->name('announcements.update')->middleware('permission.checker:manage_announcements_edit');
		Route::delete('/{announcement}/delete', [AnnouncementController::class, 'delete'])->name('announcements.delete')->middleware('permission.checker:manage_announcements_delete');
	});

	// Users
	Route::group(['prefix' => 'users'], function () {
		Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission.checker:manage_users_index');
		Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('permission.checker:manage_users_create');
		Route::post('/store', [UserController::class, 'store'])->name('users.store')->middleware('permission.checker:manage_users_create');
		Route::get('/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission.checker:manage_users_show');
		Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission.checker:manage_users_edit');
		Route::patch('/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware('permission.checker:manage_users_edit');
		Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('users.delete')->middleware('permission.checker:manage_users_delete');
	});

	// Roles
	Route::group(['prefix' => 'roles'], function () {
		Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission.checker:manage_roles_index');
		Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission.checker:manage_roles_create');
		Route::post('/store', [RoleController::class, 'store'])->name('roles.store')->middleware('permission.checker:manage_roles_create');
		Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('permission.checker:manage_roles_show');
		Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission.checker:manage_roles_edit');
		Route::patch('/{role}/update', [RoleController::class, 'update'])->name('roles.update')->middleware('permission.checker:manage_roles_edit');
		Route::delete('/{role}/delete', [RoleController::class, 'delete'])->name('roles.delete')->middleware('permission.checker:manage_roles_delete');
	});

	// Categories
	Route::group(['prefix' => 'categories'], function () {
		Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('permission.checker:manage_categories_index');
		Route::get('/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('permission.checker:manage_categories_create');
		Route::post('/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('permission.checker:manage_categories_create');
		Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show')->middleware('permission.checker:manage_categories_show');
		Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('permission.checker:manage_categories_edit');
		Route::patch('/{category}/update', [CategoryController::class, 'update'])->name('categories.update')->middleware('permission.checker:manage_categories_edit');
		Route::delete('/{category}/delete', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('permission.checker:manage_categories_delete');
	});

	// Statuses
	Route::group(['prefix' => 'statuses'], function () {
		Route::get('/', [StatusController::class, 'index'])->name('statuses.index')->middleware('permission.checker:manage_statuses_index');
		Route::get('/create', [StatusController::class, 'create'])->name('statuses.create')->middleware('permission.checker:manage_statuses_create');
		Route::post('/store', [StatusController::class, 'store'])->name('statuses.store')->middleware('permission.checker:manage_statuses_create');
		Route::get('/{status}', [StatusController::class, 'show'])->name('statuses.show')->middleware('permission.checker:manage_statuses_show');
		Route::get('/{status}/edit', [StatusController::class, 'edit'])->name('statuses.edit')->middleware('permission.checker:manage_statuses_edit');
		Route::patch('/{status}/update', [StatusController::class, 'update'])->name('statuses.update')->middleware('permission.checker:manage_statuses_edit');
		Route::delete('/{status}/delete', [StatusController::class, 'delete'])->name('statuses.delete')->middleware('permission.checker:manage_statuses_delete');
	});

	// Priorities
	Route::group(['prefix' => 'priorities'], function () {
		Route::get('/', [PriorityController::class, 'index'])->name('priorities.index')->middleware('permission.checker:manage_priorities_index');
		Route::get('/create', [PriorityController::class, 'create'])->name('priorities.create')->middleware('permission.checker:manage_priorities_create');
		Route::post('/store', [PriorityController::class, 'store'])->name('priorities.store')->middleware('permission.checker:manage_priorities_create');
		Route::get('/{priority}', [PriorityController::class, 'show'])->name('priorities.show')->middleware('permission.checker:manage_priorities_show');
		Route::get('/{priority}/edit', [PriorityController::class, 'edit'])->name('priorities.edit')->middleware('permission.checker:manage_priorities_edit');
		Route::patch('/{priority}/update', [PriorityController::class, 'update'])->name('priorities.update')->middleware('permission.checker:manage_priorities_edit');
		Route::delete('/{priority}/delete', [PriorityController::class, 'delete'])->name('priorities.delete')->middleware('permission.checker:manage_priorities_delete');
	});

	// Settings
	Route::group(['prefix' => 'settings'], function () {
		Route::get('/', [SettingController::class, 'index'])->name('settings.index');
	});

});

require __DIR__ . '/auth.php';
