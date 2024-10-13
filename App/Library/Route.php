<?php

namespace App\Library;

use App\Library\Uri;
use App\Library\RouteOptions;

class Route
{
  private ?RouteOptions $routeOptions = null;
  private ?Uri $uri = null;

  public function __construct(
    // public string $uri,
    public string $request,
    public string $controller,
  ) { }

  public function addRouteGroupOptions(RouteOptions $routeOptions)
  {
    $this->routeOptions = $routeOptions;
  }

  public function getRouteOptionsInstance(): ?RouteOptions
  {
    return $this->routeOptions;
  }

  public function addRouteUri(Uri $uri)
  {
    $this->uri = $uri;
  }

  public function getRouteUriInstance(): ?Uri
  {
    return $this->uri;
  }

  /* private function currentUri()
  {
    return $_SERVER['REQUEST_URI'] !== '/' ? rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : '/';
  }

  private function currentRequest()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  } */

  public function match()
  {
    if($this->routeOptions->optionExists('prefix')){
      $this->uri->setUri(rtrim("/{$this->routeOptions->execute('prefix')}{$this->uri->getUri()}", '/'));
    }

    if (
      $this->uri->getUri() === $this->uri->currentUri() &&
      strtolower($this->request) === $this->uri->currentRequest()
    ) {
      return $this;
    }
  }
}
