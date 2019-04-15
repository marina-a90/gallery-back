<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(100), 
        'description' => $faker->realText(300),
        'user_id' => rand(1, count(App\User::all()))
    ];
});
