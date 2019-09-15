<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/users', 'UsersController@getAllUsers');

$router->post('/auth/login', 'AuthController@login');
