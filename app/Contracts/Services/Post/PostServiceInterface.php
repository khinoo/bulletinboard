<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
  //get user list
  public function savePost($request);
  public function getPostByUser();
  public function getPostByUserId($id);
  public function destroyPost($id);
  public function userSearch($request);
}
