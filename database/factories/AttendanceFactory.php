<?php

use App\Models\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 500),
        'date' => $faker->date(),
        'start_time' => time(),
        'end_time' => time(),
    ];
});
