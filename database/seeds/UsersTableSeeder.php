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
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'administrator@mail.com',
            'status' => '1',
            'type' => 'Admin',
            'password' => bcrypt('123456')
        ]);
    }
}
