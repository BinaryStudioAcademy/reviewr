<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
   
    protected $table = 'comments';
  
    public $timestamps = true;
  
    protected $fillable = ['text', 'user_id', 'review_request_id'];
  
    public static $rules = array(
        'text'=>'required|min:1|max:200',
    );

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function request()
    {
        return $this->belongsTo('App\ReviewRequest');
    }

}