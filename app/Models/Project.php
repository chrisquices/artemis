<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model {

	use HasFactory;

	protected $dates = ['started_at'];

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function projectUsers()
	{
		return $this->hasMany(ProjectUser::class);
	}

	public function tickets()
	{
		return $this->hasMany(Ticket::class);
	}

	public function getPhotoUrlAttribute()
	{
		if ($this->photo) {
			return config('app.url') . Storage::url($this->photo);
		}

		return asset('assets/images/logo.png');
	}

}
