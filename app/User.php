<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';
	public $timestamps = false;
	protected $fillable = ['first_name', 'last_name', 'email'];
	protected $hidden = ['password', 'remember_token'];

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public function job()
	{
		return $this->hasOne('Job');
	}

	public function requests()
	{
		return $this->hasMany('ReviewRequest');
	}
}
