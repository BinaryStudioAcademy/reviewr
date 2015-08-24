<?php

use Illuminate\Database\Seeder;
use App\ReviewRequest;
use App\User;
use App\Group;

class ReviewRequestTableSeeder extends Seeder {

	public function run()
	{
        $faker = Faker\Factory::create();

        $userIds = User::lists('id')->toArray();
        $groupIds = Group::lists('id')->toArray();

        foreach(range(1,20) as $index)
        {
            ReviewRequest::create([
                'title' => $faker->text(25),
                'details' => $faker->realtext(1000),
                'reputation' => $faker->randomDigitNotNull,
                'date_review' => $faker->dateTimeBetween('-1 days', '+15 days'),
                'user_id' => $faker->randomElement($userIds),
                'group_id' => $faker->randomElement($groupIds)
            ]);
        }
	}
}