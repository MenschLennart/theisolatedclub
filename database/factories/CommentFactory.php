<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $activity_id = $faker->numberBetween(1,30);

    return [
        'subject' => $faker->sentence(),
        'body' => $faker->realText(),
        'activity_id' => $activity_id,
        'user_id' => $faker->numberBetween(1,20),
        'commentable_id' => $activity_id,
        'commentable_type' => App\Activity::class
    ];
});
