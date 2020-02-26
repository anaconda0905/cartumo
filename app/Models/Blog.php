<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function comments()
	{
		return $this->hasMany('App\Models\BlogComment');
	}

	/*public function blogHasCategory()
	{
		return $this->hasMany('App\BlogHasCategory');
	}*/
	
}