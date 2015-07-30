<?php

use Illuminate\Database\Seeder;
use App\ReviewRequest;

class ReviewRequestTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('review_requests')->delete();

		// ReviewRequestTableSeeder
		ReviewRequest::create(array(
				'title' => 'Tittle RR',
				'details' => 'details RR',
				'reputation' => '3',
				'user_id' => 1,
				'group_id' => 1
			));
	}
}