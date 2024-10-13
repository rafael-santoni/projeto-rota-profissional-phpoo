<?php

namespace App\Controllers;

use App\library\View;

class StatusCheckoutController
{
  public function success()
  {
    return View::render('success');
  }

  public function cancel()
  {
    return View::render('cancel');
  }
}
