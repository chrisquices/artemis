<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {

	use HasFactory;

	protected $dates = ['submitted_at'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function announcementUsers()
	{
		return $this->hasMany(AnnouncementUser::class);
	}

	public function getIdFormattedAttribute()
	{
		return str_pad($this->id, 5, '0', STR_PAD_LEFT);
	}

}
