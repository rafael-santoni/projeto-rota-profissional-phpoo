<?php

namespace App\Library;

use Exception;

class Controller
{
  // private const NAMESPACE = 'App\\Controllers\';

  public function call(Route $route)
  {
    $controller = $route->controller;

    if (!str_contains($controller, ':')) {
      throw new Exception("Colon need to controller {$controller} in route");
    }

    [$controller, $action] = explode(':', $controller);

    $controllerInstance = "App\\Controllers\\" . $controller;

    if (!class_exists($controllerInstance)) {
      throw new Exception("Controller {$controller} does not exist");
    }

    $controller = new $controllerInstance;

    if (!method_exists($controller, $action)) {
      throw new Exception("Action {$action} does not exist");
    }
    call_user_func_array([$controller, $action], []);
  }
}
