<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\User;
use App\ReviewRequest;

class CommentTableSeeder extends Seeder {

	public function run()
	{
        $faker = Faker\Factory::create();

        $userIds = User::lists('id')->toArray();
        $reviewRequestIds = ReviewRequest::lists('id')->toArray();

        foreach(range(1,50) as $index)
        {
            Comment::create([
                'text' => $faker->text(200),
                'user_id' => $faker->randomElement($userIds),
                'review_request_id' => $faker->randomElement($reviewRequestIds),
            ]);
        }
	}
}