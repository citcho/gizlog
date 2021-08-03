<?php

use App\Models\Question;
use Faker\Core\Number;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 4),
        'title' => $faker->title,
        'content' => $faker->sentence(rand(1,4)) . PHP_EOL . $faker->sentence(rand(1,4)),
    ];
});
