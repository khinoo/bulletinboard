<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
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
