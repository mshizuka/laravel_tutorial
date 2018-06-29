<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post_id'=>$faker->numberBetween($min = 1, $max = 20),
        'name' => $faker->name,
	    'comment' => $faker->text,
    ];
});
