<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewRequest extends Model {

	protected $table = 'review_requests';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

}