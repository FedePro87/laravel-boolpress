<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
  return [
    'author'=>$faker->name,
    'title'=>$faker->sentence(6,true),
    'content'=>$faker->paragraph(6,true)
  ];
});
