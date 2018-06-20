<?php

require 'vendor/autoload.php';

spl_autoload_register( function( $class_name ) {
  //echo "$class_name <br /><br />";
  $file_name = './Controllers/' . $class_name . '.php';
  if( file_exists( $file_name ) ) {
    require_once($file_name);
  }
});

require_once('routes.php');

?>

<html>
  <head>
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
  </head>
  <body>

  <br /><br />
  <form action="/patients" method="POST">
     Run the route that calls PatientsController::create();
     <input type="submit" value="Submit">
  </form>
  <form action="/patients/2/metrics" method="POST">
     Run the route that calls PatientsMetricsController::create();
     <input type="submit" value="Submit">
  </form>

  <div>
      <button type="submit" onclick="callControllerFunctions('PATCH',  '/patients/2')">PatientsController@update</button>
      <button type="submit" onclick="callControllerFunctions('DELETE', '/patients/2')">PatientsController@delete</button>
      <br /><br />
      <button type="submit" onclick="callControllerFunctions('PATCH',  '/patients/2/metrics/abc')">PatientsMetricsController@update</button>
      <button type="submit" onclick="callControllerFunctions('DELETE', '/patients/2/metrics/abc')">PatientsMetricsController@delete</button>
      <br /><br />
      <div>Response from AJAX call : <span id="response"></span></div>
  </div>

  <script type="text/javascript">
    function callControllerFunctions(method, url) {
        $.ajax({
          type: method,
          url: url,
          async: true,
          cache: false,
          dataType: "JSON",
          success: function(result) {
              console.log("success on ajax");
              console.log(result);
              $("#response").html(result);
          },
          error: function(data, etype) {
              console.log("error on ajax");
              console.log(data);
              console.log(etype);
          }
        });
    }
  </script>
  </body>
</html>
