<?php

$routes = [
    '/product/(:numeric)',   //[0-9]+
    '/user/(:alpha)',    // [a-z]+
    '/post/(:any)'  // [a-z0-9\-]+
];
