<?php

namespace App\Database\Seeds;

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UserTableSeeder extends Seeder
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

            \App\User::query()->create([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'avatar' => $faker->imageUrl(300,300),
                'password' => $faker->password,
                'about' => $faker->text,
                'sex' => array_first($faker->randomElements(['man', 'woman']))
            ])->roles()->sync([
                Role::findByName('admin')->id
            ]);

        }

        $tester = User::create([
           'email' => 'tester@example.com',
           'password' => 'password',
           'name' => 'Tester'
        ]);

        $tester->roles()->sync([
           Role::findByName('admin')->id
        ]);

        $normal = User::create([
            'email' => 'normal@example.com',
            'password' => Hash::make('password'),
            'name' => 'Normal user'
        ]);

        $normal->roles()->sync([
            Role::findByName('member')->id
        ]);

    }
}
