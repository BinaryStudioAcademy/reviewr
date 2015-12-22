<?php

use Illuminate\Database\Seeder;
use App\ReviewRequest;
use App\User;
use App\Group;

class ReviewRequestTableSeeder extends Seeder {

	public function run()
	{
        $faker = Faker\Factory::create();
        $requests = [
            [
                "title"   => "Asciit code review",
                "details" => "Would you like to join to our review?"
            ],
            [
                "title"   => "Reviewr code review",
                "details" => "We have fixed almost all bugs after the last review. Just look at this miracle! It works!"
            ],
            [
                "title"   => "Calendar code review",
                "details" => "Ok, we prepared a few of the new features, but we need a piece of good advise."
            ],
            [
                "title"   => "User profile code review",
                "details" => "Hello! We're glad to invite you to our code review. We have done everything. Our code base is very stable."
            ],
            [
                "title"   => "News code review",
                "details" => "Hi! We invite you to take a look at our code. We improved an architecture."
            ],
            [
                "title"   => "Questionnaire code review",
                "details" => "Ok, we are ready to share our experience of TDD on our project. Feel free to join."
            ],
            [
                "title"   => "Hunter code review",
                "details" => "Hello! We're waiting fo your assessment. Would you like to join?"
            ],
            [
                "title"   => "Feedbacks code review",
                "details" => "Hello everybody! Can you estimate our new approach?"
            ],
            [
                "title"   => "Interview code review",
                "details" => "Hello! Please, help use to check the usability of our new interface."
            ],
            [
                "title"   => "Accounting code review",
                "details" => "Hi there! So, we are ready to describe and share our stable code base. Please, offer us an opinion about it."
            ],
            [
                "title"   => "Hunter code review",
                "details" => "Hi there! Please, take a look to result of our great work."
            ],
            [
                "title"   => "Reviewr",
                "details" => "Hello! Reviewr is ready for review."
            ],
        ];

        $userIds = User::lists('id')->toArray();
        $groupIds = Group::lists('id')->toArray();

        foreach($requests as $reviewRequest) {
           ReviewRequest::create([
                'title' => $reviewRequest['title'],
                'details' => $reviewRequest['details'],
                'date_review' => $faker->dateTimeBetween('-1 days', '+15 days'),
                'user_id' => $faker->randomElement($userIds),
                'group_id' => $faker->randomElement($groupIds)
            ]);
        }
	}
}