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
        foreach (range(1,100) as $index) {
            $user = \App\User::find(1);

            $new = $user->news()->create([
                'short_name' => $faker->name,
                'full_name' => $faker->shuffleString(),
                'is_private' => $faker->boolean,
                'display_author' => $faker->boolean,
                'text' => $faker->text,
                'image' => $faker->imageUrl(200, 500),
                'description' => $faker->paragraph
            ]);

            $new->tags()->sync(range(1,100));
        }
    }
}
