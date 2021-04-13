<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;

class LoginController extends Controller
{
    public function login()
    {

      return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect('user/login')->with('error', 'Email or password is incorrect');
    }

    public function logout() 
    {
      Auth::logout();

      return redirect('user/login');
    }

    public function home()
    {
      	if(Auth::user()->id == 1){
            $posts = DB::table('posts')
            ->select('users.name','posts.*')
            ->leftjoin('users', 'posts.create_user_id', '=', 'users.id')
            ->paginate(5);
        }else{
            $posts =  DB::table('posts')->where('create_user_id', Auth::user()->id)->paginate(5);
        }
     	return view('auth.home',compact('posts'));
    }
}
