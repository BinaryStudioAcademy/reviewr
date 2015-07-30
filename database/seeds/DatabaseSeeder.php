<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('CommentTableSeeder');
		$this->command->info('Comment table seeded!');

		$this->call('ReviewRequestTableSeeder');
		$this->command->info('ReviewRequest table seeded!');
	}
}