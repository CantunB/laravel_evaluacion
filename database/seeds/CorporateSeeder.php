<?php

use App\Models\Corporate;
use Illuminate\Database\Seeder;

class CorporateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $corporativos = factory(Corporate::class, 10)->create();
        /*factory(App\User::class, 50)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}
