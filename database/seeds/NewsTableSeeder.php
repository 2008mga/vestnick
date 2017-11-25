<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,400) as $index) {
            $user = \App\User::find(rand(1,App\User::count()));


            $new = $user->news()->create([
                'short_name' => $faker->name,
                'full_name' => $faker->streetName,
                'is_private' => $faker->boolean,
                'display_author' => $faker->boolean,
                'text' => $faker->paragraph(rand(100, 500)),
                'image' => $faker->imageUrl(200, 500),
                'cover' => $faker->imageUrl(960, 300),
                'description' => $faker->paragraph
            ]);

            $new->tags()->sync(range(1,50, rand(1, 10)));
        }
    }
}
