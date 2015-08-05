<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table = 'departments';
  
    public $timestamps = false;
  
    protected $fillable = ['title'];
  
    public static $rules = array(
        'title'=>'required|min:1|max:200|alpha',
    );

    public function user()
    {
        return $this->belongsToMany('User');
    }

}