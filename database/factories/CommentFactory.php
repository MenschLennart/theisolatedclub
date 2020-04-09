<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    return [
        'subject' => $faker->sentence(),
        'text' => $faker->realText(),
        'activity_id' => $faker->numberBetween(1,30),
        'user_id' => $faker->numberBetween(1,20)
    ];
});
