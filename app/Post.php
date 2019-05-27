<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable=[
    'author',
    'title',
    'content'
  ];

  function categories(){
    return $this->belongsToMany(Category::class);
  }
}
