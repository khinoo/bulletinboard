<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts/createpost');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        return redirect('/postlist');
    }

    public function confirm(Request $request)
    {
        // dd($request);
        $id = null;
        if($request->input('id') != null) {
            $id = $request->input('id');
        }
        $title = $request->input('title');
        $description = $request->input('description');
        $status = ($request->input('status') == "on") ? 1 : 0;

        return view('posts/confirmpost', ['title' => $title, 'description' => $description, 'id' => $id, 'status' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(Auth::user()->id == 1){
            $posts = DB::table('posts')->whereNull('deleted_at')->paginate(10);
        }else{
            $posts =  DB::table('posts')->where('create_user_id', Auth::user()->id)->whereNull('deleted_at')->paginate(10);
        }

        return view('posts/postlist',compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        $title = $posts->title;
        $description = $posts->description;
        $status = $posts->status;
        // dd($title);
        return view('posts/createpost', ['title' => $title, 'description' => $description, 'id' => $id, 'status' => $status]);    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->deleted_at =  Carbon::now();
        $post->deleted_user_id = Auth::user()->id;
        $post->save();
        return redirect('/postlist');
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');
        $posts = DB::table('posts')
            ->leftjoin('users', 'posts.create_user_id', '=', 'users.id')
            ->where('posts.title', 'LIKE', "%{$search}%")
            ->orWhere('posts.description', 'LIKE', "%{$search}%")
            ->orWhere('users.name', 'LIKE', "%{$search}%")
            ->paginate(10);
        // dd($posts);

        // Return the search view with the resluts compacted
        return view('posts/postlist', compact('posts'));
    }

    public function uploadview()
    {
        return view('posts/uploadview');
    }
}
