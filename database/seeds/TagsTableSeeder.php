<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class TagsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,50) as $index) {

            \App\Tag::query()->create([
                'name' => $faker->name,
                'additional_color' => $faker->hexColor,
                'image' => $faker->imageUrl(500,500),
                'description' => $faker->paragraph,
            ]);

        }
    }
}
