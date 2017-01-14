<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'administrator@mail.com',
                'status' => '1',
                'type' => 'Admin',
                'is_activated' => '1',
                'password' => bcrypt('123456')
            ],
            [
                'id' => 2,
                'name' => 'Client',
                'email' => 'client@mail.com',
                'status' => '1',
                'type' => 'Client',
                'is_activated' => '1',
                'password' => bcrypt('123456')
            ],
            [
                'id' => 3,
                'name' => 'Support',
                'email' => 'support@mail.com',
                'status' => '1',
                'type' => 'Support',
                'is_activated' => '1',
                'password' => bcrypt('123456')
            ]
        ]);
    }
}
