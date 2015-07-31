<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{

    protected $table = 'badges';
    public $timestamps = true;
    protected $fillable = ['title', 'icon'];

}