<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{

    protected $table = 'group_user';
    public $timestamps = false;

    public function groups()
    {
        return $this->belongsToMany('Group');
    }

    public function users()
    {
        return $this->belongsToMany('User');
    }

}