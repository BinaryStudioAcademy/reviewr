<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewRequest extends Model
{
    use SoftDeletes;

    protected $table = 'review_requests';
   
    public $timestamps = true;
   
    protected $fillable = ['title', 'details', 'reputation'];

    public static $rules = array(
        'title'=>'required|min:2|max:100',
    );

    protected $dates = ['deleted_at'];
      
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_review_request');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('isAccepted');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}