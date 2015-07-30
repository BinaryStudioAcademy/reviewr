<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('comments')->delete();

		// CommentTableSeeder
		Comment::create(array(
				'text' => 'comment text',
				'user_id' => 1
			));
	}
}