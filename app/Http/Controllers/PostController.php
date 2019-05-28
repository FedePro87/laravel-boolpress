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
    $posts=Post::offset(0)->limit(5)->latest()->get();
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
    $post=Post::findOrFail($id);
    $categories=Category::all();
    return view('layout.update-post',compact('post', 'categories'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(PostRequest $request, $id)
  {
    $validateData = $request->validated();
    $selectedCategories = $request->input('categories');
    $post=Post::findOrFail($id);
    $post->update($validateData);

    $categories = Category::find($selectedCategories);
    $post->categories()->sync($categories);
    return redirect('posts');
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

  public function showSearch()
  {
    $categories=Category::all();
    return view('layout.advancedSearch',compact('categories'));
  }

  private function searchAll($author, $title, $content, $category)
  {
    $finalResults=[];

    $results=Post::where([
      ['author', '=', $author],
      ['title', '=', $title],
      ['content', '=', $content],
      ])->get();

    foreach ($results as $result) {
      $allPostCategories= $result->categories;
        foreach ($allPostCategories as $singlePostCategory) {
          if ($singlePostCategory->id==$category) {
            $finalResults[]=$results;
          } else {
            echo "Non ci sono risultati!";
          }
        }
      }

      return $finalResults;
    }

    public function showAdvancedSearchResults()
    {
      $categories=Category::all();

      if ($_GET['author']!="" & $_GET['title']!="" & $_GET['content']!="") {
        $results=$this->searchAll($_GET['author'], $_GET['title'], $_GET['content'], $_GET['category']);
      } elseif ($_GET['author']!="" & $_GET['title']!="") {
        $results=$this->searchAuthorTitle();
      } elseif ($_GET['author']!="" & $_GET['content']!="") {
        $results=$this->searchAuthorContent();
      } elseif ($_GET['title']!="" & $_GET['content']!="") {
        $results=$this->searchTitleContent();
      } elseif ($_GET['author']!="") {
        $results=$this->searchAuthor();
      } elseif ($_GET['title']!="") {
        $results=$this->searchTitle();
      } elseif ($_GET['content']!="") {
        $results=$this->searchContent();
      }

      return view('layout.advancedSearch',compact('results','categories'));
    }

  }
