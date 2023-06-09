<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model {

	use HasFactory;

	protected $table = 'project_user';

	public function project()
	{
		return $this->hasMany(Project::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
