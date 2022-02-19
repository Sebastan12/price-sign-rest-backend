<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/pricesigns', 'PricesignController@index');
$router->get('/pricesigns/{id}', 'PricesignController@show');
$router->post('/pricesigns/create', 'PricesignController@store');
$router->post('/pricesigns/update/{id}', 'PricesignController@update');
$router->delete('/pricesigns/destroy/{id}', 'PricesignController@destroy');

$router->get('/', function () use ($router) {
    return $router->app->version();
});
