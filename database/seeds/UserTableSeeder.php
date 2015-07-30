<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('users')->delete();

		// UserTableSeeder
		User::create(array(
				'first_name' => 'Alex',
				'last_name' => 'Ivanov',
				'email' => 'ivanov@mail.ru',
				'phone' => '+380501234567',
				'avatar' => 'avatar3658.jpg',
				'address' => 'Iv. Franko str., 666',
				'password' => bcrypt('123456'),
				'reputation' => 14,
				'job_id' => 1,
				'department_id' => 1
			));
	}
}