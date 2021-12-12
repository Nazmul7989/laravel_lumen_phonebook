<?php

/** @var \Laravel\Lumen\Routing\Router $router */



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register','RegisterController@register');

$router->post('/login','LoginController@login');
$router->get('/test',['middleware' => 'auth', 'uses' => 'LoginController@test']);


$router->group(['middleware' => 'auth'],function () use($router){
    $router->get('/phone','PhoneBookController@index');
    $router->post('/phone','PhoneBookController@store');
    $router->delete('/phone','PhoneBookController@destroy');
});
