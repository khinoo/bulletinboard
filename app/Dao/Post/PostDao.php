<?php

namespace App\Dao\Post;

use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;

class PostDao implements PostDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function savePost($request)
  {
    $post = new Post();
    if($request->input('id') != null) {
        $post = Post::find($request->input('id'));
        $post->title =   $request->title;
        $post->description = $request->description;
        $post->status = ($request->input('status') == "on") ? 1 : 0;
        $post->updated_user_id = Auth::user()->id;
        $post->updated_at = Carbon::now();
    }else{
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = 1;
        $post->create_user_id = Auth::user()->id;
        $post->updated_user_id = Auth::user()->id;
        $post->created_at = Carbon::now();
        $post->updated_at = Carbon::now();
    }
    
    $post->save();
  }
  public function getPostByUser()
  {
    if(Auth::user()->id == 1){
        $posts = DB::table('posts')
        ->select('users.name','posts.*')
        ->leftjoin('users', 'posts.create_user_id', '=', 'users.id')
        ->whereNull('posts.deleted_at')->paginate(10);
    }else{
        $posts =  DB::table('posts')
        ->select('users.name','posts.*')
        ->leftjoin('users', 'posts.create_user_id', '=', 'users.id')
        ->whereNull('posts.deleted_at')
        ->where('posts.create_user_id', Auth::user()->id)->whereNull('posts.deleted_at')->paginate(10);
    }

    return $posts;
  }
  public function getPostByUserId($id)
  {
    return Post::find($id);
  }
  public function destroyPost($id)
  {
    $post = $this->getPostByUserId($id);  
    $post->deleted_at =  Carbon::now();
    $post->deleted_user_id = Auth::user()->id;
    $post->save();
  }
  public function userSearch($request)
  {
    $search = $request->input('search');
    $posts = DB::table('posts')
        ->select('users.name','posts.*')
        ->leftjoin('users', 'posts.create_user_id', '=', 'users.id')
        ->where('posts.title', 'LIKE', "%{$search}%")
        ->orWhere('posts.description', 'LIKE', "%{$search}%")
        ->orWhere('users.name', 'LIKE', "%{$search}%")
        ->paginate(10);
    
    return $posts;
  }
}

