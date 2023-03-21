<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

	use HasFactory;

	protected $dates = ['submitted_at'];

	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function priority()
	{
		return $this->belongsTo(Priority::class);
	}

	public function notes()
	{
		return $this->hasMany(Note::class);
	}

	public function reportedByUser()
	{
		return $this->belongsTo(User::class, 'reported_by_user_id', 'id');
	}

	public function assignedToUser()
	{
		return $this->belongsTo(User::class, 'assigned_to_user_id', 'id');
	}

	public function getIdFormattedAttribute()
	{
		return str_pad($this->id, 5, '0', STR_PAD_LEFT);
	}

}
