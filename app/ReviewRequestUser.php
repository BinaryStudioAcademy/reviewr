<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewRequestUser extends Model {

    protected $table = 'review_request_user';
    public $timestamps = true;

    public function review_requests()
    {
        return $this->belongsToMany('ReviewRequest');
    }

    public function users()
    {
        return $this->belongsToMany('User');
    }

}