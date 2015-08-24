<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        DB::statement('SET foreign_key_checks = 0;');
        DB::table('departments')->truncate();
        DB::table('jobs')->truncate();
        DB::table('users')->truncate();
        DB::table('groups')->truncate();
        DB::table('review_requests')->truncate();
        DB::table('comments')->truncate();
        DB::table('tags')->truncate();
        DB::table('tag_review_request')->truncate();
        DB::table('badges')->truncate();
        DB::table('review_request_user')->truncate();
        DB::statement('SET foreign_key_checks = 1;');

        $this->call('DepartmentTableSeeder');
        $this->call('JobTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('GroupTableSeeder');
        $this->call('ReviewRequestTableSeeder');
        $this->call('CommentTableSeeder');
        $this->call('TagTableSeeder');
        $this->call('BadgeTableSeeder');
        $this->call('ReviewRequestUserTableSeeder');

        Model::reguard();
        
    }
}