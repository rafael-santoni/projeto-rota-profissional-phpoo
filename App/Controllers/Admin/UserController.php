<?php

namespace App\Controllers\Admin;

class UserController
{
  public function index($userId, $userName)
  {
    dump('UserController -> index()', "Usuário: {$userId}, Name: {$userName}");
  }
  
  public function show($userName)
  {
    dump('UserController -> show()', "User Name: {$userName}");
  }
}
