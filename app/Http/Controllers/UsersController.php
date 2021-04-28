<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Session;

class UsersController extends Controller
{
    private $userInterface;
    /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(UserServiceInterface $userInterface)
  {

    $this->middleware('auth');
    $this->userInterface = $userInterface;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userInterface->getUserList();
        return view('users/userlist',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = null;
        return view('users/createuser',[ 'id' => $id, 'filename' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->userInterface->saveUser($request);
        if($request->input('id') != null){
            $message = 'Updated User Successfully !';
        }else{
            $message = 'Created User Successfully !';
        }
        return redirect('/userlist')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = $this->userInterface->getUserById();
        $filename = substr($user->profile,9);

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
        $users = $this->userInterface->getEditUserById($id);
        $name = $users->name;
        $email = $users->email;
        $dob = $users->dob;
        $address = $users->address;
        $filename = substr($users->profile,9);

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
        $this->userInterface->destroyUser($id);
        return redirect('/userlist')->with('success','User Deleted Successfully !');
    }

    public function usersearch(Request $request)
    {
        $users = $this->userInterface->userSearch($request);
        // Return the search view with the resluts compacted
        return view('users/userlist', ['users' => $users,'request' => $request ]);
    }

    public function userconfirm(Request $request)
    {   
        if($request->id == null){
            $validator = Validator::make($request->all(), [
                 'name' => 'required|string|unique:users',
                 'email' => 'required|string | email | unique:users',
                 'password' => 'required|min:6|max:10|confirmed',
                 'password_confirmation' => 'required|min:6|max:10'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if($request->image != null){
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
      
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
        $confirmpsw = $request->input('password_confirmation');
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
        $user = $this->userInterface->getEditUserById($request->id);
        $current_password = $user->password;

        if(!Hash::check($request->current_password, $current_password))
        {   
            $error = array('current-password' => 'Please enter correct current password');
            return redirect()->back()->withErrors($error);
        }elseif(strcmp($request->new_password, $request->new_confirm_password) != 0){ 
            $error = array('new-confirm-password' => 'New Password and New Confirm Password cannot be same.');
            return redirect()->back()->withErrors($error);
        }else {       
            $this->userInterface->updateUserPassword($request);
            return redirect('/postlist')->with('success','Password Change Successfully !');
        }
    }
}
