<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
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
    $post=Post::make($validateData);

    $inputAuthor= Auth::user()->name;
    $user= User::where('name','=',$inputAuthor)->first();
    $post->user()->associate($user);
    $post->save();

    if ($request->input('categories')!==null) {
      $selectedCategories = $request->input('categories');
      $categories = Category::findOrFail($selectedCategories);

      foreach ($categories as $category) {
        $post->categories()->attach($category);
      }
    }

    return redirect(route('home'))->with('success',"Il post è stato pubblicato!");
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $results=[];
    $posts=Post::all();
    foreach ($posts as $post) {
      if ($post->id==$id) {
        $results[]=$post;
        break;
      }
    }
    return view('layout.search', compact('results'));
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
    return redirect(route('home'))->with('success',"Il post è stato modificato!");
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $postToDelete= Post::findOrFail($id);
    DB::table('category_post')->where('post_id','=',$id)->delete();
    $postToDelete->delete();

    return redirect(route('home'))->with('success',"Il post è stato eliminato!");
  }
  public function getPostByCategory($category_name){
    $results=[];
    $posts=Post::all();
    $category=Category::where('category_name','=',$category_name)->first();

    foreach ($posts as $post) {
      $postCategories= $post->categories;
      foreach ($postCategories as $postCategory) {
        if ($category->category_name==$postCategory->category_name) {
          $results[]=$post;
          break;
        }
      }
    }

    return view('layout.search', compact('results'));
  }

  private function getSearchingParams($author, $title, $content, $category)
  {
    $searchingParams=-1;

    if ($_GET['author_id']!="" & $_GET['title']!="" & $_GET['content']!="") {
      $searchingParams=[['author_id', '=', "$author"],['title', 'LIKE', "%$title%"],['content', 'LIKE', "%$content%"]];
    } elseif ($_GET['author_id']!="" & $_GET['title']!="") {
      $searchingParams=[['author_id', '=', "$author"],['title', 'LIKE', "%$title%"]];
    } elseif ($_GET['author_id']!="" & $_GET['content']!="") {
      $searchingParams=[['author_id', '=', "$author"],['content', 'LIKE', "%$content%"]];
    } elseif ($_GET['title']!="" & $_GET['content']!="") {
      $searchingParams=[['title', 'LIKE', "%$title%"],['content', 'LIKE', "%$content%"]];
    } elseif ($_GET['author_id']!="") {
      $searchingParams=[['author_id', '=', "$author"]];
    } elseif ($_GET['title']!="") {
      $searchingParams=[['title', 'LIKE', "%$title%"]];
    } elseif ($_GET['content']!="") {
      $searchingParams=[['content', 'LIKE', "%$content%"]];
    } else {
      $searchingParams=[['id','REGEXP','^[0-9]+$']];
    }

    return $searchingParams;
  }

  private function search($author, $title, $content, $category_id)
  {
    $finalResults=[];

    $results=Post::where($this->getSearchingParams($author, $title, $content, $category_id))->get();

    foreach ($results as $result) {
      $allPostCategories= $result->categories;
      foreach ($allPostCategories as $singlePostCategory) {
        if ($singlePostCategory->id==$category_id) {
          $finalResults[]=$result;
          break;
        }
      }
    }

    return $finalResults;
  }

  public function showAdvancedSearchResults()
  {
    $categories=Category::all();
    $authors=Author::all();

    if (isset($_GET['author_id']) & isset($_GET['title']) & isset($_GET['content']) & isset($_GET['category_id'])) {
      $searchedAuthor=$_GET['author_id'];
      $title=$_GET['title'];
      $content=$_GET['content'];
      $searchedCategory=$_GET['category_id'];
      $results=$this->search($searchedAuthor, $title, $content, $searchedCategory);

      return view('layout.advancedSearch',compact('results','categories','authors','searchedAuthor','title','content','searchedCategory'));
    } else {
      return view('layout.advancedSearch',compact('categories','authors'));
    }

  }

}
