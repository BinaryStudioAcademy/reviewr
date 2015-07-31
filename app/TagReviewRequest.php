<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagReviewRequest extends Model {

	protected $table = 'tag_review_request';
	public $timestamps = false;

	public function requests()
	{
		return $this->belongsToMany('ReviewRequest');
	}

	public function tags()
	{
		return $this->belongsToMany('Tag');
	}

}