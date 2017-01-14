<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'level' => 99
            ],
            [
                'id' => 2,
                'name' => 'Support',
                'slug' => 'support',
                'level' => 90
            ],
            [
                'id' => 3,
                'name' => 'Client',
                'slug' => 'client',
                'level' => 90
            ]
        ]);
        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1
            ],
            [
                'role_id' => 2,
                'user_id' => 3
            ],
            [
                'role_id' => 3,
                'user_id' => 2
            ]
        ]);
    }
}
