<?php

use Illuminate\Database\Seeder;
use App\User;
use App\ReviewRequest;

class ReviewRequestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requestsIds = ReviewRequest::lists('id')->toArray();
        $userIds = User::lists('id')->toArray();

        for ($i=1; $i < count($requestsIds) - 1; $i++)
        {
            for ($k=1; $k < rand(0, 8); $k++)
            {
                DB::table('review_request_user')->insert([
                    'review_request_id' => $i,
                    'user_id' => rand(1, count($userIds)),
                ]);
            }
        }
    }
}