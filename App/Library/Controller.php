<?php

namespace App\Library;

use App\Library\Middleware;
use Exception;

class Controller
{
  // private const NAMESPACE = 'App\\Controllers\';

  private function controllerPath($route, $controller)
  {
    return ($route->getRouteOptionsInstance() && $route->getRouteOptionsInstance()->optionExists('controller')) ?
      "App\\Controllers\\" . $route->getRouteOptionsInstance()->execute('controller') . '\\' . $controller :
      "App\\Controllers\\" . $controller;
  }

  public function call(Route $route)
  {
    $controller = $route->controller;

    if (!str_contains($controller, ':')) {
      throw new Exception("Colon need to controller {$controller} in route");
    }

    [$controller, $action] = explode(':', $controller);

    $controllerInstance = $this->controllerPath($route, $controller);

    if (!class_exists($controllerInstance)) {
      throw new Exception("Controller {$controller} does not exist");
    }

    $controller = new $controllerInstance;

    if (!method_exists($controller, $action)) {
      throw new Exception("Action {$action} does not exist");
    }

    //Middlewares
    if($route->getRouteOptionsInstance()?->optionExists('middlewares')) {
      (new Middleware($route->getRouteOptionsInstance()->execute('middlewares')))->execute();
    }

    // $controller->$action(...$route->getRouteWildcardInstance()->getParams());
    call_user_func_array([$controller, $action], $route->getRouteWildcardInstance()?->getParams() ?? [] );
  }
}
