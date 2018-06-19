<?php
namespace Routing;

class Route {

  public static $uri;
  public static $uri_pattern;
  public static $method;
  public static $controller;
  public static $action; //controller method

  public static $router;

  public function __construct() {
    
  }


  /*
   * @param Router $router object instance
   * @return void;
   */
  public function setRouter($router) {
    self::$router = $router;
  }

  /*
   * get, post, patch, delete methods used by the resources method, or for manual route definitions
   * @param string $uri : holds uri's in the format : /routeName/{paramName}
   * @param string $action : holds desired action in the format : ControllerName@controllerMemberFunctionName
   * @return void
   */
  public static function get($uri, $action) {
    self::$uri = $uri;
    self::getUriPattern();
    self::$method = "GET";
    self::$controller = explode('@', $action)[0];
    self::$action = explode("@",$action)[1];
    self::$router->setRoute(self::$uri, self::$uri_pattern, self::$method, self::$controller, self::$action);
  }

  public static function post($uri, $action) {
    self::$uri = $uri;
    self::getUriPattern();
    self::$method = "POST";
    self::$controller = explode('@', $action)[0];
    self::$action = explode("@",$action)[1];
    self::$router->setRoute(self::$uri, self::$uri_pattern, self::$method, self::$controller, self::$action);
  }

  public static function patch($uri, $action) {
    self::$uri = $uri;
    self::getUriPattern();
    self::$method = "PATCH";
    self::$controller = explode('@', $action)[0];
    self::$action = explode("@",$action)[1];
    self::$router->setRoute(self::$uri, self::$uri_pattern, self::$method, self::$controller, self::$action);
  }

  public static function delete($uri, $action) {
    self::$uri = $uri;
    self::getUriPattern();
    self::$method = "DELETE";
    self::$controller = explode('@', $action)[0];
    self::$action = explode("@",$action)[1];
    self::$router->setRoute(self::$uri, self::$uri_pattern, self::$method, self::$controller, self::$action);
  }

  /*
   * Get a regex representation of a uri
   * Used to match with current url and obtain parameters from capture groups (if any)
   * @return void (sets $uri_pattern of self)
   */
  private function getUriPattern() {
    //start our pattern - this will be a start-finish pattern
    self::$uri_pattern = '^';

    //If there is a leading /, remove it
    self::$uri = strpos(self::$uri, '/')==0 ? ltrim(self::$uri, '/') : self::$uri;

    //for each uri segment
    foreach(explode('/', self::$uri) as $segment) {
      if(strpos($segment, "{")!==false) {
        //if the segment represents a parameter, set the regex to be any number/letter combination
        //with atleast one number/letter being present. And set as capture group
        self::$uri_pattern.= "\/([0-9A-z]+)";
      } else {
        //otherwise prepend a / to the segment
        self::$uri_pattern.="\/$segment";
      }
    }
    //allow trailing slashes and specify the end of the pattern
    self::$uri_pattern.="\/?$";
  }

  /*
   * @param : string $name
   *    name of resource
   *    '.' separates nested routes and used for controller naming scheme.
   * Creates an index, get, create, update, and delete routes
   * @return void (registers routes with the Router class)
   */
  public function resource($name) {
    $controllerName = '';
    $uriSegmentArray = [];
    foreach(explode('.', $name) as $nameSegment) {
      $controllerName.=ucfirst($nameSegment);
      $uriSegmentArray[] = $nameSegment;
    }
    $controllerName.="Controller";
    $lastSegment = $uriSegmentArray[count($uriSegmentArray)-1];
    $uri_array = [ ["uri" => "{$lastSegment}" , "action" => "{$controllerName}@index", "method" => 'get'],
                   ["uri" => "{$lastSegment}/{{$lastSegment}Id}" , "action" => "{$controllerName}@get", "method" => 'get'],
                   ["uri" => "{$lastSegment}" , "action" => "{$controllerName}@create", "method" => 'post'],
                   ["uri" => "{$lastSegment}/{{$lastSegment}Id}" , "action" => "{$controllerName}@update", "method" => 'patch'],
                   ["uri" => "{$lastSegment}/{{$lastSegment}Id}" , "action" => "{$controllerName}@delete", "method" => 'delete']];

    if(count($uriSegmentArray)>1) {
      for($i=count($uriSegmentArray)-2;$i>=0;$i--) {
        for($k=0;$k<count($uri_array);$k++) {
          $uri_array[$k]["uri"] = "/{$uriSegmentArray[$i]}/{{$uriSegmentArray[$i]}Id}/".$uri_array[$k]["uri"];
        }
      }
    }

    for($i=0;$i<count($uri_array);$i++) {
      self::{$uri_array[$i]['method']}($uri_array[$i]['uri'], $uri_array[$i]['action']);
    }
  }
}
?>
