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
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@email.com',
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl(150, 150, 'abstract'),
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);

        User::create([
                'first_name' => 'test',
                'last_name' => 'test',
                'email' => 'test@email.com',
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl(150, 150, 'abstract'),
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);

        foreach(range(1,20) as $index)
        {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl(150, 150, 'abstract'),
                'address' => $faker->address,
                'password' => bcrypt('password'),
                'reputation' => $faker->randomDigitNotNull,
                'job_id' => $faker->randomElement($jobIds),
                'department_id' => $faker->randomElement($departmentIds)
            ]);
        }

    }
}