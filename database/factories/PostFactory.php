<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content' => $faker->text,
        'user_id' => $faker->numberBetween(1,2)
        ];
});
