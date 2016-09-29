<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'status' => random_int(0, 1),
    ];
});


$factory->define(\Bican\Roles\Models\Role::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'slug' => str_slug($faker->name,'.'),
        'level' => random_int(50, 99),
    ];
});
