<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Job;
use App\Department;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $jobIds = Job::lists('id')->toArray();
        $departmentIds = Department::lists('id')->toArray();

        User::create([
            'first_name' => 'Alex',
            'last_name' => 'Adminov',
            'email' => 'admin@email.com',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);

        User::create([
            'first_name' => 'Tim',
            'last_name' => 'Testuser',
            'email' => 'test@email.com',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);

        User::create([
            'first_name' => 'Alexey',
            'last_name' => 'Tsinya',
            'email' => 'tsinya.alexey@gmail.com',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);


        User::create([
            'first_name' => 'Alex',
            'last_name' => 'Mokrenko',
            'email' => 'alex.mokrencko@yandex.ru',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);

        User::create([
            'first_name' => 'Vladimir',
            'last_name' => 'Cherniuk',
            'email' => 'reegerye@gmail.com',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);

        User::create([
            'first_name' => 'Alexey',
            'last_name' => 'Vdovichenko',
            'email' => 'alexey.vdovichenko@binary-studio.com',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);


        User::create([
            'first_name' => 'Michael',
            'last_name' => 'Morozov',
            'email' => 'michael.morozov@binary-studio.com',
            'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
            'country' => $faker->country,
            'city' => $faker->city,
            'password' => bcrypt('password'),
            'reputation' => $faker->randomDigitNotNull,
            'job_id' => $faker->randomElement($jobIds),
            'department_id' => $faker->randomElement($departmentIds)
        ]);

        foreach(range(1,10) as $index)
        {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
                'country' => $faker->country,
                'city' => $faker->city,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);
        }

    }
}