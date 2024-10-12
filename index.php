<?php

$wildcards = [
    '(:numeric)' => '[0-9]+',
    '(:alpha)' => '[a-z]+',
    '(:any)' => '[a-z0-9\-]+'
];

$routes = [
    '/product/(:numeric)',   //[0-9]+
    '/product/(:numeric)/name/(:alpha)',   //[0-9]+ | [a-z]+
    '/user/(:alpha)',    // [a-z]+
    '/post/(:any)'  // [a-z0-9\-]+
];

$routeFound = '';

foreach($routes as $route) {
    if(str_contains($route, '(:numeric)')){
        $route = str_replace('(:numeric)', $wildcards['(:numeric)'], $route);
    }

    if(str_contains($route, '(:alpha)')){
        $route = str_replace('(:alpha)', $wildcards['(:alpha)'], $route);
    }

    if(str_contains($route, '(:any)')){
        $route = str_replace('(:any)', $wildcards['(:any)'], $route);
    }

    $pattern = str_replace('/', '\/', ltrim($route, '/'));

    // var_dump($pattern, ltrim($_SERVER['REQUEST_URI'], '/'));

    if(preg_match("/^$pattern$/", trim($_SERVER['REQUEST_URI'], '/'))) {
        // var_dump('Achei a rota: '. $route.' -> com o padrão: '.$pattern);
        $routeFound = $route;
    }
    
    // var_dump($route, $pattern);
}

var_dump($routeFound);
