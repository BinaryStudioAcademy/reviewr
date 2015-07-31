<?php

use Illuminate\Database\Seeder;
use App\Badge;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1,10) as $index)
        {
            Badge::create([
                'title' => $faker->colorName,
                'icon' => $faker->imageUrl(80, 80, 'abstract'),
            ]);
        }
    }
}
