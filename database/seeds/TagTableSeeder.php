<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            Tag::create([
                'title' => $faker->unique()->word,
            ]);
        }

        // Insert 3 random tag in every RR

        $tagIds    = Tag::lists('id')->toArray();
        $reviewIds = \App\ReviewRequest::lists('id')->toArray();

        foreach ($reviewIds as $rid) {
            DB::table('tag_review_request')->insert([
                [
                    'review_request_id' => $rid,
                    'tag_id'            => $faker->randomElement($tagIds),
                ],
                [
                    'review_request_id' => $rid,
                    'tag_id'            => $faker->randomElement($tagIds),
                ],
                [
                    'review_request_id' => $rid,
                    'tag_id'            => $faker->randomElement($tagIds),
                ]
            ]);
        }


    }
}
