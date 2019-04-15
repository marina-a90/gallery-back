<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 200)->create()
        ->each(function ($comment) {
            $gallery = App\Gallery::inRandomOrder()->first();
            $comment -> gallery_id = $gallery->id;
            $comment -> save();
        });
    }
}
