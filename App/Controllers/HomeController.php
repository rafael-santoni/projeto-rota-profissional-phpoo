<?php

namespace App\Controllers;

use App\Library\Cart;
use App\Library\View;
use App\Database\Models\User;
use App\Database\Models\Product;

class HomeController
{
  public function index()
  {
    $products = Product::all('id,name,slug,price,image');

    View::render('home', ['products' => $products]);
  }
}
