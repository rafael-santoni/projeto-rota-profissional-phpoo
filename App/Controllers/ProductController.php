<?php

namespace App\Controllers;

class ProductController
{
  public function index($productName)
  {
    dump('ProductController -> index()', "Produto: {$productName}");
  }
}
