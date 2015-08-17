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
                'phone' => $faker->phoneNumber,
                'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);

        User::create([
                'first_name' => 'Tim',
                'last_name' => 'Testuser',
                'email' => 'test@email.com',
                'phone' => $faker->phoneNumber,
                'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
                'address' => $faker->address,
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
                'phone' => $faker->phoneNumber,
                'avatar' => 'http://www.gravatar.com/avatar/' . $faker->md5. '?d=identicon',
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);
        }

    }
}