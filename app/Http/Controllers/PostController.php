<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Author;
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
    $authors=Author::all();
    return view('layout.create-post',compact('categories','authors'));
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

    $inputAuthor=$request->input('author');
    $author= Author::find($inputAuthor);
    $post->author()->associate($author);
    $post->save();

    $selectedCategories = $request->input('categories');
    $categories = Category::find($selectedCategories);

    foreach ($categories as $category) {
      $post->categories()->attach($category);
    }

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
    $author=$post->author;
    return view('layout.update-post',compact('post', 'categories','author'));
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

  private function search($author, $title, $content, $category)
  {
    $finalResults=[];

    $results=Post::where($this->getSearchingParams($author, $title, $content, $category))->get();

    foreach ($results as $result) {
      $allPostCategories= $result->categories;
      foreach ($allPostCategories as $singlePostCategory) {
        if ($singlePostCategory->id==$category) {
          $finalResults[]=$result;
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
