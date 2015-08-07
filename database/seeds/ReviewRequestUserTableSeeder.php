<?php

use Illuminate\Database\Seeder;

class ReviewRequestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 12; $i++)
        {
            for ($k=1; $k < 6; $k++)
            {
                DB::table('review_request_user')->insert([
                    'review_request_id' => $i,
                    'user_id' => $k,
                ]);
            }
        }
    }
}