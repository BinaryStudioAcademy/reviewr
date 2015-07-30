<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadgeUser extends Model {

	protected $table = 'badge_user';
	public $timestamps = true;

	public function bages()
	{
		return $this->belongsToMany('Badge');
	}

	public function users()
	{
		return $this->belongsToMany('User');
	}

}