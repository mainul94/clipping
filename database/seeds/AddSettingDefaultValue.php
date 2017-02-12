<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddSettingDefaultValue extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'name' => 'default_ftp',
                'options' => "{'host':'97.107.128.147'}"
            ],
            [
                'id' => 2,
                'name' => 'email_setting',
                'options' => 'null'
            ]
        ]);
    }
}
