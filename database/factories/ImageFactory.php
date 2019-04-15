<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'imageURL' => $faker->imageUrl($width = 640, $height = 480), 
        'gallery_id' => rand(1, count(App\Gallery::all()))
    ];
});
