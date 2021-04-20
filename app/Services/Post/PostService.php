<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function savePost($request)
  {
    return $this->postDao->savePost($request);
  }
  public function getPostByUser()
  {
    return $this->postDao->getPostByUser();
  }
  public function getPostByUserId($id)
  {
    return $this->postDao->getPostByUserId($id);
  }
  public function destroyPost($id)
  {
    return $this->postDao->destroyPost($id);
  }
  public function userSearch($request)
  {
    return $this->postDao->userSearch($request);
  }
}
