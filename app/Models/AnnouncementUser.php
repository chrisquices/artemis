<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementUser extends Model {

	use HasFactory;

	protected $table = 'announcement_user';

	public function announcement()
	{
		return $this->belongsTo(Announcement::class);
	}

}
