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
    	if (empty($setting->options)) {
    		$setting->options = [];
    	}
        return $setting;
    }else {
        return null;
    }
};

function get_company_logo()
{
    $logo = get_setting('logo');
    return $logo? url($logo->options['file_logo']) : '/images/f-icon.png';
}