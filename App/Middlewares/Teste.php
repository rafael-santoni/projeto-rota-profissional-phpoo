<?php

namespace App\Middlewares;

use App\Interfaces\MiddlewareInterface;

class Teste implements MiddlewareInterface
{
  public function execute()
  {
    dump('execute middleware teste');
  }
}