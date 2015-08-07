<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['title' => 'PHP']);
        Group::create(['title' => 'JS']);
        Group::create(['title' => '.Net']);
    }
}
