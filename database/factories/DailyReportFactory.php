<?php

use App\Models\DailyReport;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(DailyReport::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'reporting_time' => $faker->dateTimeBetween('-100day', 'now')->format('Y-m-d'),
        'title' => $faker->title,
        'content' => $faker->sentence(rand(1,4)) . PHP_EOL . $faker->sentence(rand(1,4)),
    ];
});
