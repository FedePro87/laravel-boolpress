<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
  return [
    'title'=>$faker->sentence(6,true),
    'content'=>$faker->paragraph(6,true),
    'likes'=>$faker->numberBetween(1,100)
  ];
});
