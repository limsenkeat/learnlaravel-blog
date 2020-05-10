<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'category_id' => rand(1,3),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'image' => $faker->imageUrl('900', '300'),
    ];
});
