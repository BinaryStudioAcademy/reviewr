<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewRequest extends Model
{

    protected $table = 'review_requests';
    public $timestamps = true;
    protected $fillable = ['title', 'details', 'reputation'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
        
    public function comments()
    {
        return $this->hasMany('Comment');
    }

}