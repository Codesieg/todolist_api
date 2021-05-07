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

$router->get(
    '/',
    [
        'uses' => 'MainController@home',
        'as'   => 'main-home'
    ]
);

$router->get(
    '/categories',
    [
        'uses' => 'CategoryController@list',
        'as'   => 'category-list'
    ]
);

$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item',
        'as'   => 'category-item'
    ]
);

$router->delete(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@delete',
        'as'   => 'category-delete'
    ]
);

$router->get(
    '/tasks',
    [
        'uses' => 'TasksController@list',
        'as'   => 'tasks-list'
    ]
);


$router->get(
    '/tasks/{id}',
    [
        'uses' => 'TasksController@item',
        'as'   => 'tasks-item' 
    ]
);

$router->post(
    '/tasks',
    [
        'uses' => 'TasksController@add',
        'as'   => 'tasks-add'
    ]
);

$router->delete(
    '/tasks/{id}',
    [
        'uses' => 'TasksController@delete',
        'as'   => 'tasks-delete'
    ]
);

$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TasksController@update',
        'as'   => 'tasks-update'
    ]
);

$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TasksController@update',
        'as'   => 'tasks-update'
    ]
);

