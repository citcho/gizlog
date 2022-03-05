<?php

use App\Models\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 500),
        'date' => $faker->dateTimeBetween('-2 week', 'now')->format('Y-m-d'),
        // 9:00~11:00
        'start_time' => date('H:i:s', rand(0, 7200)),
        // 18:00~20:00
        'end_time' => date('H:i:s', rand(32400, 39600)),
        'is_absent' => rand(0, 1),
    ];
});
