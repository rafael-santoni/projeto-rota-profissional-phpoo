<?php

namespace App\Library;

use App\Enums\RouteMiddlewares;
use App\Interfaces\MiddlewareInterface;
use Exception;

class Middleware
{
  private string $middlewareClass;

  public function __construct(protected array $middlewares) { }

  private function middlewareExists(string $middleware)
  {
    $casesMiddleware = RouteMiddlewares::cases();
    
    return array_filter($casesMiddleware, function(RouteMiddlewares $middlewareCase) use($middleware) {

      if($middlewareCase->name === $middleware) {
        $this->middlewareClass = $middlewareCase->value;
        return true;
      }

      return false;
    });
  }

  public function execute()
  {
    foreach ($this->middlewares as $middleware) {
      if(!$this->middlewareExists($middleware)) {
        throw new Exception("Middeware {$middleware} does not exist");
      }
      
      $class = $this->middlewareClass;
      if(!class_exists($class)) {
        throw new Exception("Middeware class {$class} does not exist");
      }

      $middlewareClass = new $class;      
      if(!$middlewareClass instanceof MiddlewareInterface) {
        throw new Exception("Middeware {$class} must implements App\Interfaces\MiddlewareInterface");
      }

      $middlewareClass->execute();
    }
  }
}
