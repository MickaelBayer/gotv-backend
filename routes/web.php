<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('login', 'AuthController@login');
        $router->post('logout', 'AuthController@logout');
        $router->post('register', 'AuthController@register');
    });
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UsersController@getAllUsers');
    });
        $router->group(['prefix' => 'tmdb'], function () use ($router) {
        $router->get('/', 'TmdbController@testTmdb');
    });
});
