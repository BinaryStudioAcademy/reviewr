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
        $tag_titles = [
            'php',
            'javascript',
            'c#',
            'design',
            'css',
            'forms',
            'gulp',
            'marionette',
            'backbone',
            'jquery',
            'laravel',
            'laravel5',
            'f3',
            'zend',
            'zend2',
            'yii',
            'yii2',
            'node-js',
            'node',
            'code-ignite',
            'maven',
            'symfony2',
            'rest',
            'email',
            'unit-testing',
            'mono',
            'jade',
            'express',
            'tlp',
            'underscore',
            'pagination',
            'mvc',
            'bootstrap',
            'documentation',
            'popup',
            'collection',
            'mysql',
            '.net',
            'arrays',
            'ajax',
            'regex',
            'json',
            'angular',
            'wordpress',
            'string',
            'html5',
            'git',
            'svn',
            'apache',
            'postgresql',
            '.htaccess',
            'function',
            'file',
            'image',
            'gd',
            'phantomjs',
            'sorting',
            'http',
            'opencv',
            'firefox',
            'ubuntu',
            'grep',
            'gmail-api'
        ];

        foreach ($tag_titles as $title) {
            Tag::create([
                'title' => $title,
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
