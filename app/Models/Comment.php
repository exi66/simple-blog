<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes, HasFactory;
	
	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function post() {
		return $this->belongsTo('App\Models\Post');
	}	
	
	protected $fillable = [
        'user_id',
	'post_id',
        'description'
    ];
}
