<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {

    $category = $faker->numberBetween(1,7);
    if($category === 5) {
        $type = $faker->numberBetween(6,10);
    } else {
        $type = $faker->numberBetween(1,5);
    }

    return [
        'title' => $faker->text('18'),
        'content' => $faker->sentence,
        'link' => $faker->url,
        'category_id' => $category,
        'type_id' => $type,
        'user_id' => $faker->numberBetween(1,20)
    ];
});
