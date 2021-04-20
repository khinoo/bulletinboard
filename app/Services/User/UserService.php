<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function getUserList()
  {
    return $this->userDao->getUserList();
  }
  public function getUserById()
  {
    return $this->userDao->getUserById();
  }
  public function saveUser($request)
  {
    return $this->userDao->saveUser($request);
  }
  public function getEditUserById($id)
  {
    return $this->userDao->getEditUserById($id);
  }
  public function destroyUser($id)
  {
    return $this->userDao->destroyUser($id);
  }
  public function userSearch($request)
  {
    return $this->userDao->userSearch($request);
  }
  public function updateUserPassword($request)
  {
    return $this->userDao->updateUserPassword($request);
  }
}
