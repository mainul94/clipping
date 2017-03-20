<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AddLogoData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name'=>'logo',
            'options'=>'{"file_logo":"settings/ca-logo.png"}'
        ]);
    }
}
