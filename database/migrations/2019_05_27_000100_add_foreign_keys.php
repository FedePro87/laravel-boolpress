<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddForeignKeys extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('category_post',function(Blueprint $table){
      $table->foreign('category_id')
      ->references('id')
      ->on('categories');

      $table->foreign('post_id')
      ->references('id')
      ->on('posts');
    });

    Schema::table('posts',function(Blueprint $table){
      $table->foreign('user_id')
      ->references('id')
      ->on('users');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::table('category_post',function(Blueprint $table){
      $table->dropForeign(['category_id']);
      $table->dropForeign(['post_id']);
    });

    Schema::table('posts',function(Blueprint $table){
      $table->dropForeign(['user_id']);
    });
  }
}
