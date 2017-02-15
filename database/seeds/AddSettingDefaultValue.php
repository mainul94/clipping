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
                'id' => 2,
                'name' => 'email_setting',
                'options' => '{"driver":"smtp","host":"smtp.zoho.com","port":"465","username":"arif@dizitronbd.com","password":"diziarif","encryption":"tsl"}'
            ]
        ]);
    }
}
