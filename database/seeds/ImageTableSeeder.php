<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Image::class, 200)->create()
        ->each(function ($image) {
            $gallery = App\Gallery::inRandomOrder()->first();
            $image -> gallery_id = $gallery->id;
            $image -> save();
        });
    }
}
