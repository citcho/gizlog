<?php

use App\Models\DailyReport;
use Faker\Generator as Faker;

$factory->define(DailyReport::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 4),
        'reporting_time' => $faker->dateTimeBetween('-100day', 'now')->format('Y-m-d'),
        'title' => $faker->title,
        'content' => $faker->sentence(rand(1, 4)) . PHP_EOL . $faker->sentence(rand(1, 4)),
    ];
});
