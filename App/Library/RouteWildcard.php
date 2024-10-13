<?php

namespace App\Library;

use App\Enums\RouteWildcard as EnumsRouteWildcard;

class RouteWildcard
{
  private string $wildcardReplaced;

  public function replaceWildcardWithPattern(string $uriToReplace)
  {
    $this->wildcardReplaced = $uriToReplace;
    if(str_contains($this->wildcardReplaced, '(:numeric)')) {
      $this->wildcardReplaced = str_replace('(:numeric)', EnumsRouteWildcard::numeric->value, $this->wildcardReplaced);
    }

    if(str_contains($this->wildcardReplaced, '(:alpha)')) {
      $this->wildcardReplaced = str_replace('(:alpha)', EnumsRouteWildcard::alpha->value, $this->wildcardReplaced);
    }

    if(str_contains($this->wildcardReplaced, '(:any)')) {
      $this->wildcardReplaced = str_replace('(:any)', EnumsRouteWildcard::any->value, $this->wildcardReplaced);
    }
  }

  public function getWildcardReplaced(): string
  {
    return $this->wildcardReplaced;
  }
}
