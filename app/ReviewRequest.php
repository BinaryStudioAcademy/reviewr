<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewRequest extends Model
{
    use SoftDeletes;

    protected $table = 'review_requests';
    public $timestamps = true;

    protected $fillable = ['title', 'details', 'date_review',
    'user_id', 'group_id'];

    protected $hidden = ['updated_at', 'deleted_at'];

    public static $rules = array('title'=>'required|min:2|max:100');

    protected $dates = ['deleted_at', 'date_review'];

    protected $appends = ['offers_count'];
      
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_review_request');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('isAccepted', 'status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function getOffersCountAttribute()
    {
        return $this->users()->count();
    }
}