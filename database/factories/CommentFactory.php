<?php

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 4),
        'question_id' => $faker->numberBetween(1, 100),
        'content' => $faker->sentence(rand(1,4)) . PHP_EOL . $faker->sentence(rand(1,4)),
    ];
});
