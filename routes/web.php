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
$router->group(
    [
        'prefix' => '',
        'middleware' => []
    ],
    function() use ($router) {

    $router->group(['middleware' => []], function () use ($router) {
        $router->get('/', function () use ($router) {
            $res['success'] = true;
            $res['data'] = [
                'app_name' => env('APP_NAME', true),
                'app_version' => env('APP_VERSION',true),
            ];
            return response($res);
        });
    });


    $router->group([
        'prefix' => 'api/v1'
    ], function() use ($router) {
        $router->group(
            ['prefix' => 'city'],
            function() use ($router) {
                $router->post('/create', ['middleware' => [], 'uses' => 'CityController@create']);
                $router->get('/', ['middleware' => [], 'uses' => 'CityController@index']);
        });
    });
});
