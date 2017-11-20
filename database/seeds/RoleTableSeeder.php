<?php

namespace App\Database\Seeds;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name' => 'admin',
            'can' => ['*']
        ]);

        \App\Role::create([
            'name' => 'member',
            'can' => [
                'view',
                'comment'
            ]
        ]);

        \App\Role::create([
            'name' => 'guest',
            'can' => [
                'view'
            ]
        ]);
    }
}
