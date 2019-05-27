<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(){
    $posts=Post::latest()->offset(0)->limit(5)->get();
    return view('layout.home', compact('posts'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $categories=Category::all();
    return view('layout.create-post',compact('categories'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(PostRequest $request)
  {
    $validateData = $request->validated();
    $selectedCategories = $request->input('categories');
    $post= Post::create($validateData);

    $categories = Category::find($selectedCategories);
    $post->categories()->attach($categories);
    return redirect('posts');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $relatedPosts=[];
    $posts=Post::all();
    foreach ($posts as $post) {
      if ($post->id==$id) {
        $relatedPosts[]=$post;
      }
    }
    return view('layout.search', compact('relatedPosts'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
  public function getPostByCategory($category_name){
    $relatedPosts=[];
    $posts=Post::all();
    foreach ($posts as $post) {
      $relatedCategories= $post->categories;
      foreach ($relatedCategories as $relatedCategory) {
        if ($relatedCategory->category_name==ucfirst($category_name)) {
          $relatedPosts[]=$post;
        }
      }
    }
    return view('layout.search', compact('relatedPosts'));
  }
}
