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
            'first_name' => 'Eduard',
            'last_name'  => 'Dolinsky',
            'email'      => 'eduard.dolinskyi@binary-studio.com',
            'binary_id'  => '56780606215c82267c1a3cc0'
        ]);

        User::create([
            'first_name' => 'Oleksandr',
            'last_name'  => 'Kovalov',
            'email'      => 'kovalov.oleksandr@binary-studio.com',
            'binary_id'  => '56782867215c82267c1a3cc1'
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
            'binary_id'  => '5679241f215c82267c1a3cc4'
        ]);
    }
}
