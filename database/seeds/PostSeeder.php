<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Post::class, 20)->make()
      ->each(function($post){
        $author=App\User::inRandomOrder()->first();
        $post->user()->associate($author);
        $post->save();
        $categories=App\Category::inRandomOrder()->take(5)->get();
        $post->categories()->attach($categories);
      });
    }
}
