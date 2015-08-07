<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        $this->call('DepartmentTableSeeder');
        $this->call('JobTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('GroupTableSeeder');
        $this->call('ReviewRequestTableSeeder');
        $this->call('CommentTableSeeder');
        $this->call('TagTableSeeder');
        $this->call('BadgeTableSeeder');
        $this->call('ReviewRequestUserTableSeeder');
        
    }
}