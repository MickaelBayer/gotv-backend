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
        $router->get('/{id}', 'UsersController@getUserById');
        $router->post('/', 'UsersController@postUser');
        $router->put('/{id}', 'UsersController@putUserById');
        $router->delete('/{id}', 'UsersController@deleteUserById');
    });

    $router->group(['prefix' => 'events'], function () use ($router) {
        $router->get('/', 'EventsController@getAllEvents');
        $router->get('/{id}', 'EventsController@getEventById');
        $router->post('/', 'EventsController@postEvent');
        $router->put('/{id}', 'EventsController@putEventById');
        $router->delete('/{id}', 'EventsController@deleteEventById');
    });

    $router->group(['prefix' => 'series'], function () use ($router) {
        $router->get('/', 'SeriesController@getAllSeries');
        $router->get('/{id}', 'SeriesController@getSerieById');
        $router->post('/', 'SeriesController@postSerie');
        $router->put('/{id}', 'SeriesController@putSerieById');
        $router->delete('/{id}', 'SeriesController@deleteSerieById');
    });

    $router->group(['prefix' => 'categories'], function () use ($router) {
        $router->get('/', 'CategoriesController@getAllCatSeries');
        $router->get('/{id}', 'CategoriesController@getCatSerieById');
        $router->post('/', 'CategoriesController@postCatSerie');
        $router->put('/{id}', 'CategoriesController@putCatSerieById');
        $router->delete('/{id}', 'CategoriesController@deleteCatSerieById');
    });

    $router->group(['prefix' => 'subscriptions'], function () use ($router) {
        $router->get('/', 'SubscriptionsController@getAllSubscriptions');
        $router->get('/{id}', 'SubscriptionsController@getSubscriptionById');
        $router->post('/', 'SubscriptionsController@postSubscription');
        $router->put('/{id}', 'SubscriptionsController@putSubscriptionById');
        $router->delete('/{id}', 'SubscriptionsController@deleteSubscriptionById');
    });

    $router->group(['prefix' => 'votes'], function () use ($router) {
        $router->get('/', 'VotesController@getAllVotes');
        $router->get('/{id}', 'VotesController@geVotenById');
        $router->post('/', 'VotesController@postVote');
        $router->put('/{id}', 'VotesController@putVoteById');
        $router->delete('/{id}', 'VotesController@deleteVoteById');
    });

    $router->group(['prefix' => 'roles'], function () use ($router) {
        $router->get('/', 'RolesController@getAllRoles');
        $router->get('/{id}', 'RolesController@getRoleById');
        $router->post('/', 'RolesController@postRole');
        $router->put('/{id}', 'RolesController@putRoleById');
        $router->delete('/{id}', 'RolesController@deleteRoleById');
    });

    $router->group(['prefix' => 'platform-series'], function () use ($router) {
        $router->get('/', 'PlatformSeriesController@getAllPlatformSeries');
        $router->get('/{id}', 'PlatformSeriesController@getPlatformSerieById');
        $router->post('/', 'PlatformSeriesController@postPlatformSerie');
        $router->put('/{id}', 'PlatformSeriesController@putPlatformSerieById');
        $router->delete('/{id}', 'PlatformSeriesController@deletePlatformSerieById');
    });
    $router->group(['prefix' => 'tmdb'], function () use ($router) {
        $router->get('/', 'TmdbController@fillSeriesWithTMDB');
    });
    $router->group(['prefix' => 'categories'], function () use ($router) {
        $router->post('/', 'CategoriesSeriesController@PostCategoriesSerie');
    });
});
