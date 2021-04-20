<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
  //get user list
  public function getUserList();
  public function getUserById();
  public function saveUser($request);
  public function getEditUserById($id);
  public function destroyUser($id);
  public function userSearch($request);
  public function updateUserPassword($request);
}
