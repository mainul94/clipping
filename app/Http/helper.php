<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 2/12/17
 * Time: 1:03 AM
 */

function get_setting($name){
    $setting = \App\Setting::where('name', $name)->first();
    if ($setting) {
        return $setting;
    }else {
        return null;
    }
};