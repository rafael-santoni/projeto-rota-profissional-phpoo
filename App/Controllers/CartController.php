<?php

namespace App\Controllers;

use App\Library\Cart;
use App\Library\View;
use App\Library\Product;
use App\Library\Redirect;
use App\Database\Models\Product as ProductModel;

class CartController
{
  public function index()
  {
    View::render('cart');
  }

  public function add()
  {
    if (isset($_GET['id'])) {
      $id = strip_tags($_GET['id']);

      $productInfo = ProductModel::where('id', $id);

      $product = new Product;
      $product->setId($productInfo->id);
      $product->setSlug($productInfo->slug);
      $product->setImage($productInfo->image);
      $product->setName($productInfo->name);
      $product->setPrice($productInfo->price);
      $product->setQuantity(1);

      $cart = new Cart;
      $cart->add($product);

      Redirect::back();

      // header("Location: /cart");
    }
  }

  public function update()
  {
    $slug = strip_tags($_POST['slug']);
    $quantity = strip_tags($_POST['quantity']);
    $cart = new Cart;

    ($quantity <= 0) ?
      $cart->remove($slug) :
      $cart->update($slug, $quantity);

    return Redirect::to('/cart');
  }

  public function destroy()
  {
    if (isset($_GET['slug'])) {
      $slug = strip_tags($_GET['slug']);
      $cart = new Cart;
      $cart->remove($slug);
      return Redirect::back();
    }
  }
}
