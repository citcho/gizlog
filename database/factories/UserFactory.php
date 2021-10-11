<?php

use App\Models\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slack_user_id' => $faker->asciify('**********'),
        'email' => $faker->unique()->safeEmail,
        'avatar' => 'https://i.pinimg.com/236x/18/64/f1/1864f1c531cf2ee82c7400bb298f4b2d.jpg',
        'remember_token' => str_random(10),
    ];
});
