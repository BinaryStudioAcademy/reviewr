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

        foreach(range(1,30) as $index)
        {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl(80, 80, 'people'),
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);
        }

    }
}