# SimpleRouter

# Larvel insired simple REST/ Resourceful Router
```
  //in your routes.php define the router
  //required: add a Router instance to Route
  $router = new Router();
  Route::setRouter($router);
  
  //after all your routes are defined use the mathRoutes method to check if the current $_SERVER request 
  //matches a registered route
  Route::$router->matchRoute();

  /********************************************************************************************************/

  //Single routes defined:
  Route::get('/', 'HomeController@index);
  Route::get('/patients/{id}', 'PatientsController@get');
  Route::post('/patients', 'PatientsController@create');
  //get, post, patch, delete supported.
  
  //Or you can define a resource
  Route::resource(patients);
  /* This creates these 5 routes
   * Route::get('/patients', 'PatientsController@index');
   * Route::get('/patients/{patientsId}', 'PatientsController@get');
   * Route::post('/patients', 'PatientsController@create');
   * Route::patch('/patients/{patientsId}', 'PatientsController@update');
   * Route::delete('/patients/{patientsId}', 'PatientsController@delete');
   */
   
   //Nested resources are also supported
   Route::resource(patients.metrics);
   /* This creates these 5 routes
    * Route::get('/patients/{patientsId}/metrics', 'PatientsMetricsController@index');
    * Route::get('/patients/{patientsId}/metrics/{metricsId}', 'PatientsMetricsController@get');
    * Route::post('/patients/{patientsId}/metrics', 'PatientsMetricsController@create');
    * Route::patch('/patients/{patientsId}/metrics/{metricsId}', 'PatientsMetricsController@update');
    * Route::delete('/patients/{patientsId}/metrics/{metricsId}', 'PatientsMetricsController@delete');
    */
```

Currently the 'where' clause isn't supported. All parameters are allowed to be within the /[0-9A-z]+/ pattern.
Named routes are also not supported in this version. 

Routing to a page that doesnt exist or a Controller that doesnt exist will redirect to 404.php in the Router class. This need to be changed to call an error/404 controller or your own static 404 page. 
