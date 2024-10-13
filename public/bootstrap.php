<?php

use App\Library\Router;
use Dotenv\Dotenv;

require '../vendor/autoload.php';

session_start();

$dotenv = Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$route = new Router;
