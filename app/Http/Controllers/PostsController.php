<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PostsController extends Controller
{
    private $postInterface;
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(PostServiceInterface $postInterface)
    {

        $this->middleware('auth');
        $this->postInterface = $postInterface;
    }
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
        $this->postInterface->savePost($request);
        return redirect('/postlist');
    }

    public function confirm(Request $request)
    {
        $id = null;
        if($request->input('id') != null) {
            $id = $request->input('id');
        }else{
            $validator = Validator::make($request->all(), [
                 'title' => 'required|string|max:255|unique:posts',
                 'description' => 'required'
            ]);

            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
               
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
        $posts = $this->postInterface->getPostByUser();
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
        $posts  = $this->postInterface->getPostByUserId($id);
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
        $this->postInterface->destroyPost($id);
        return redirect('/postlist');
    }

    public function search(Request $request)
    {
       $posts = $this->postInterface->userSearch($request);

        // Return the search view with the resluts compacted
        return view('posts/postlist', compact('posts'));
    }

    public function uploadview()
    {
        return view('posts/uploadview');
    }
}
