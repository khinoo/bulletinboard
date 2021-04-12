<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->whereNull('deleted_at')->paginate(10);
        return view('users/userlist',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("create");
        $id = null;
        return view('users/createuser',[ 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $user = new User();
        $type = ($request->input('type') == "Admin") ? 0 : 1;
        if($request->input('id') != null) {
            $user = User::find($request->input('id'));
            $user->name =   $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile = 'images/'.Auth::user()->id.'/'.$request->filename;
            $user->type = $type;
            $user->phone = $request->phone;
            $user->dob = $request->dob;
            $user->address = $request->address;
            $user->updated_user_id = Auth::user()->id;
            $user->updated_at = Carbon::now();
        }else{
            $user->name =   $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile = 'images/'.Auth::user()->id.'/'.$request->filename;
            $user->type = $type;
            $user->phone = $request->phone;
            $user->dob = $request->dob;
            $user->address = $request->address;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
        }
        
        $user->save();

        return redirect('/userlist');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user =  DB::table('users')->whereNull('deleted_at')->where('id', Auth::user()->id)->first();
        $filename = substr($user->profile,9);
        // dd($user);
        return view('users.profile', compact('user', 'filename'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $users = User::find($id);
        $name = $users->name;
        $email = $users->email;
        $dob = $users->datetimepicker1;
        $address = $users->address;
        $filename = substr($users->profile,9);
        // dd($filename);
        // dd($title);
        return view('users/createuser', ['name' => $name, 'email' => $email, 'id' => $id, 'dob' => $dob, 'address' => $address, 'filename' => $filename]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->deleted_at =  Carbon::now();
        $user->deleted_user_id = Auth::user()->id;
        $user->save();
        return redirect('/userlist');
    }

    public function usersearch(Request $request)
    {
        // Get the search value from the request
        // dd($request);
        $name = $request->input('name');
        $email = $request->input('email');
        $createdFrom = $request->input('createdFrom');
        $createdTo = $request->input('createdTo');
        if ($name) {
            $users = DB::table('users')
            ->where('users.name', 'LIKE', "%{$name}%")->paginate(10);;
        }elseif($email){
            $users = DB::table('users')
            ->where('users.email', 'LIKE', "%{$email}%")->paginate(10);;
        }elseif($createdFrom){
            $users = DB::table('users')
            ->where('users.created_at', 'LIKE', "%{$createdFrom}%")->paginate(10);;
        }elseif($createdTo){
            $users = DB::table('users')
            ->orWhere('users.created_at', 'LIKE', "%{$createdTo}%")->paginate(10);;
        }else{
            $users = DB::table('users')->paginate(10);
        }

        // Return the search view with the resluts compacted
        return view('users/userlist', compact('users'));
    }

    public function userconfirm(Request $request)
    {
        // dd($request->filename);
        
        if($request->image != null){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
      
            $imageName = time().'.'.$request->image->extension();  
       
            $request->image->move(public_path('images'), $imageName);
        }else{
            $imageName = $request->filename;
        }
        

        $id = null;
        if($request->input('id') != null) {
            $id = $request->input('id');
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirmpsw = $request->input('confirmpsw');
        $type = $request->input('type');
        $phone = $request->input('phone');
        $dob = $request->input('dob');
        $address = $request->input('address');
        $filename = $imageName;

        return view('users/userconfirm', ['name' => $name, 'email' => $email, 'id' => $id, 'password' => $password, 'confirmpsw' => $confirmpsw, 'type' => $type, 'phone' => $phone, 'dob' => $dob, 'address' => $address, 'filename' => $filename]);
    }

    public function changepasswordview($id)
    {
        return view('users/changepassword', [ 'id' => $id]);
    }

    public function changepassword(Request $request)
    {
        // dd($request);
        $user = User::find($request->id);
        $current_password = $user->password;

        if(!Hash::check($request->current_password, $current_password))
        {   
            $error = array('current-password' => 'Please enter correct current password');
            return response()->json(array('error' => $error), 400);  
        }elseif(strcmp($request->new_password, $request->new_confirm_password) != 0){ 
            $error = array('new-confirm-password' => 'New Password and New Confirm Password cannot be same.');
            return response()->json(array('error' => $error), 400);  
        }else {           
            $user = user::find($request->id);
            $user->updated_at =  Carbon::now();
            $user->updated_user_id = Auth::user()->id;
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect('/postlist');   
        }

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
