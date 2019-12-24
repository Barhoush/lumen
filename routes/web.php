<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
	'prefix'    =>  'country',
], function () use ($router){
	$router->get('{id}',   'CountriesController@get');
	$router->post('',   'CountriesController@post');
	$router->put('{id}',   'CountriesController@put');
	$router->delete('{id}',   'CountriesController@destroy');
});

$router->group([
	'prefix'    =>  'city',
], function () use ($router){
	$router->get('{id}',   'CitiesController@get');
	$router->post('',   'CitiesController@post');
	$router->put('{id}',   'CitiesController@put');
	$router->delete('{id}',   'CitiesController@destroy');
});
$router->group([
	'prefix'    =>  'address',
], function () use ($router){
	$router->get('{id}',   'AddressesController@get');
	$router->post('',   'AddressesController@post');
	$router->put('{id}',   'AddressesController@put');
	$router->delete('{id}',   'AddressesController@destroy');
});
