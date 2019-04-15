<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Gallery::class, 53)->create()
            ->each(function ($gallery) {
                $user = App\User::inRandomOrder()->first();
                $gallery -> user_id = $user->id;
                $gallery -> save();
        });
    }
    
}
