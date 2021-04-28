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
    if($request->input('type') == "Admin"){
      $type = 0;
    }elseif($request->input('type') == "User"){
      $type = 1;
    }else{
      $type = 2;
    }
    if($request->input('id') != null) {
        $user = User::find($request->input('id'));
        $user->name =   $request->name;
        $user->email = $request->email;
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
        $user->create_user_id = Auth::user()->id;
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
  	$user = $this->getEditUserById($id);  
    $user->deleted_at =  Carbon::now();
    $user->deleted_user_id = Auth::user()->id;
    $user->save();
  }
  public function userSearch($request)
  {
	  $search = $request->input('search');
    // $createdFrom = ( $request->createdFrom != null ) ? Carbon::createFromFormat('d/m/Y', $request->createdFrom)->format('Y-m-d') : null;
    // $createdTo = ( $request->createdTo != null ) ? Carbon::createFromFormat('d/m/Y', $request->createdTo)->format('Y-m-d') : null;
    // if ($name) {
    //     $users = DB::table('users')
    //     ->where('users.name', 'LIKE', "%{$name}%")->paginate(10);
    // }elseif($email){
    //     $users = DB::table('users')
    //     ->where('users.email', 'LIKE', "%{$email}%")->paginate(10);
    // }elseif($createdFrom){
    //     $users = DB::table('users')
    //     ->where('created_at', '>=', $createdFrom)->paginate(10);
    // }elseif($createdTo){
    //     $users = DB::table('users')
    //     ->where('created_at', '<=', $createdTo)->paginate(10);
    // }else{
    //     $users = DB::table('users')->paginate(10);
    // }
      $users =  DB::table('users')
         ->where('name', 'LIKE', "%{$search}%")
         ->orwhere('email', 'LIKE', "%{$search}%")
         ->paginate(10);

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
