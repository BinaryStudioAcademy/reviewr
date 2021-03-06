<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $table = 'tags';
    
    public $timestamps = false;
    
    protected $fillable = ['title'];

    protected $appends = ['requests_count'];

    public static $rules = array('title'=>'required|min:2|alpha');

    public function requests()
    {
        return $this->belongsToMany('App\ReviewRequest', 'tag_review_request');
    }

    public function getRequestsCountAttribute()
    {
        return $this->requests()->count();
    }

}