<?php

namespace App\Middlewares;

use App\Interfaces\MiddlewareInterface;
use App\Library\Auth as LibraryAuth;
use App\Library\Redirect;

class Auth implements MiddlewareInterface
{
  public function execute()
  {
    if(!LibraryAuth::isAuth()) {
      return Redirect::to('/');
    }
  }
}
