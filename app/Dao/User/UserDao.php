<?php

namespace App\Dao\User;

use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;

class UserDao implements UserDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function getUserList()
  {
    return DB::table('users')->whereNull('deleted_at')->paginate(10);
  }
  public function getUserById()
  {
  	return DB::table('users')->whereNull('deleted_at')->where('id', Auth::user()->id)->first();
  }
  public function saveUser($request)
  {
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
  }
  public function getEditUserById($id)
  {
  	return User::find($id);
  }
  public function destroyUser($id)
  {
  	$user = User::find($id);
    $user->deleted_at =  Carbon::now();
    $user->deleted_user_id = Auth::user()->id;
    $user->save();
  }
  public function userSearch($request)
  {
	$name = $request->input('name');
    $email = $request->input('email');
    $createdFrom = $request->input('createdFrom');
    $createdTo = $request->input('createdTo');
    if ($name) {
        $users = DB::table('users')
        ->where('users.name', 'LIKE', "%{$name}%")->paginate(10);
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
    return $users;
  }
  public function updateUserPassword($request)
  {
  	$user = user::find($request->id);
    $user->updated_at =  Carbon::now();
    $user->updated_user_id = Auth::user()->id;
    $user->password = Hash::make($request->new_password);
    $user->save();
  }
}
