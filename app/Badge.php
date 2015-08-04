<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'badges';
    
    public $timestamps = true;
    
    protected $fillable = ['title', 'icon'];
 
 	public static $rules = array(
        'title'=> 'required|min:2|alpha',
        'icon'=> 'required'
    );

    public function users()
    {
        return $this->belongsToMany('App\User'); 
    } 
}