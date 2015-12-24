<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Job;
use App\Department;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name'  => 'Adminovich',
            'email'      => 'admin@example.com',
            'binary_id'  => '567abd6670a3a2541ae74c9a'
        ]);

        User::create([
            'first_name' => 'Eduard',
            'last_name'  => 'Dolinsky',
            'email'      => 'eduard.dolinskyi@binary-studio.com',
            'binary_id'  => '56780606215c82267c1a3cc0'
        ]);

        User::create([
            'first_name' => 'Oleksandr',
            'last_name'  => 'Kovalov',
            'email'      => 'kovalov.oleksandr@binary-studio.com',
            'binary_id'  => '567bded7460ceb1550867504'
        ]);

        User::create([
            'first_name' => 'Andrey',
            'last_name'  => 'Tarusin',
            'email'      => 'andriy.tarusin@binary-studio.com',
            'binary_id'  => '567a4f0f215c82267c1a3cc7'
        ]);

        User::create([
            'first_name' => 'Ulyana',
            'last_name'  => 'Falach',
            'email'      => 'ulyana@binary-studio.com',
            'binary_id'  => '56782adb215c82267c1a3cc2'
        ]);

        User::create([
            'first_name' => 'Bogdan',
            'last_name'  => 'Rusinka',
            'email'      => 'rusinka.bogdan@gmail.com',
            'binary_id'  => '567920fc215c82267c1a3cc3'
        ]);

        User::create([
            'first_name' => 'Viktor',
            'last_name'  => 'Tolkushyn',
            'email'      => 'viktor@binary-studio.com',
            'binary_id'  => '567bb46309b6341935ba07cc'
        ]);
    }
}
