<?php
namespace Routing;

class Router {

    public static $routes;

    public static $url;
    public static $verb;

    public static $current;
    public static $target;

    public function __construct() {
      self::$routes = [];
      self::$verb = $_SERVER['REQUEST_METHOD'];

      //if PATH_INFO isnt set, we are at index.php
      self::$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
    }

    /*
     * Register a route (add it to the list of available routes)
     * @param string $uri
     * @param string $uri_pattern (regex string)
     * @param string $method
     * @param string $controller
     * @param string action
     * @return void
     */
    public function setRoute($uri, $uri_pattern, $method, $controller, $action) {
      if(!isset(self::$routes["$method"]["$uri"])) {
        self::$routes["$method"]["$uri"] = ["uri" => $uri,
                                            "uri_pattern" => $uri_pattern,
                                            "controller" => $controller,
                                            "action" => $action];
        //self::$current = [ "method" => "$method", "uri" => $uri, "controller" => $controller, "action" => $action];
      } //else its a douplicate and we dont want that.

    }

    /*
     * Find the route in self::$routes matching the $_SERVER url and method
     * If match is found, invoke the route's Controller::action
     * If match isnt found include 404.php (or setup your own link to an error's controller)
     * @ returns void
     */
    public function matchRoute() {
      foreach(self::$routes[self::$verb] as $route) {
        if(preg_match('/'.$route['uri_pattern'].'/', self::$url, $results)) {;
          self::invokeRoute($route, $results);
          return;
        }
      }

      //would invoke your controller for handling errors.
      echo "matchRoute";
      include_once '/../404.php';
    }

    /*
     * Call the controller and its action associated to the matching route
     * @param array $route - array for the route matching the server request
     * @param array $results - resulting array of preg_match. Holds capture group results; to be used as parameters
     * @return void
     */
    private function invokeRoute($route, $results) {
      if(class_exists($route['controller'])) {
        //no parameters were passed
        if(count($results)==1) {
          call_user_func( $route['controller'].'::'.$route['action'] );
        //call the Controller function with parameters
        } else {
          $parameters = [];

          //skip the first index because it holds the regex full match. The remaining indexes hold the capture group results
          for($i=1;$i<count($results);$i++) {
            $parameters[] = $results[$i];
          }

          call_user_func_array([$route['controller'], $route['action']],
                                $parameters);
        }
      } else {
        //would invoke your controller for handling errors.
        echo "class doesnt exist";
        include_once '/../404.php';
      }
    }
}

?>
