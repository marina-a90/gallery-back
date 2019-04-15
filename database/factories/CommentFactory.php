<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'description' => $faker->realText(300), 
        'gallery_id' => rand(1, count(App\Gallery::all())), 
        'user_id'  => rand(1, count(App\User::all()))
    ];
});
