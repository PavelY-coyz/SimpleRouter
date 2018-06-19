<?php
use Routing\Router;
use Routing\Route;

//required: add a Router instance to Route
$router = new Router();
Route::setRouter($router);

//Add your own routes in format Route::httpMethod("uri_segment/{parameter}", "ControllerName@ControllerFunction");
//or use the resource function Route::resource('segmentName1.segmentName2...segmentName_n')
//this will create index, get, create, update, and delete nested-routes for SegmentName1SegmentName2...SegmentName_n controller); 
Route::get('/', "HomeController@index");
Route::resource('patients');
Route::resource('patients.metrics');

//Check for routes matching the $_SERVER request
Route::$router->matchRoute();
?>
