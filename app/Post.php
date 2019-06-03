<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable=[
    'author_id',
    'title',
    'content'
  ];

  function categories(){
    return $this->belongsToMany(Category::class);
  }

  function user(){
    return $this->belongsTo(User::class);
  }
}
