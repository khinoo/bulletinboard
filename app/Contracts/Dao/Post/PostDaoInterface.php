<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
  //get user list
  public function savePost($request);
  public function getPostByUser();
  public function getPostByUserId($id);
  public function destroyPost($id);
  public function userSearch($request);
}
