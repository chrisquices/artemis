<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	use HasFactory;

	protected $dates = ['submitted_at'];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
