<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\Note;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller {

	public function index()
	{
		return view('dashboard');
	}

}
