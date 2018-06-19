<?php
use Routing\Router;
use Routing\Route;

$router = new Router();
Route::setRouter($router);
/*
Route::get('/', "HomeController@index");
Route::get('/patients', 'PatientsController@index');
Route::get('/patients/{id}', 'PatientsController@get');
Route::get('/patients/{id}/metrics', 'PatientsMetricsController@index');
Route::get('/patients/{id}/metrics/{abc}', 'PatientsMetricsController@get');
*/
//Route::printRoutes();
Route::get('/', "HomeController@index");
Route::resource('patients');
Route::resource('patients.metrics');

Route::$router->matchRoute();
?>
