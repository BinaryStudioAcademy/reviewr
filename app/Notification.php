<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
   
    public $timestamps = false;

    protected $fillable = ['title'];
   
    public static $rules = array(
        'title'=>'required|min:3|max:100',
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
