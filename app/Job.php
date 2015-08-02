<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
   
    public $timestamps = false;

    protected $fillable = ['position'];
   
    public static $rules = array(
        'position'=>'required|min:3|max:100',
    );

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}