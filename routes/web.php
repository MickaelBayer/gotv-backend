<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/users', 'UsersController@getAllUsers');

$router->post('/auth/login', 'AuthController@login');

$router->post('/auth/logout', 'AuthController@logout');

$router->post('/auth/register', 'AuthController@register');
