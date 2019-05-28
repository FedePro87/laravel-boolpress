<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  protected $fillable=[
    'author_name'
  ];

  function posts()
  {
    return $this->hasMany(Post::class);
  }
}
