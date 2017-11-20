<?php

namespace App\Database\Seeds;

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
