<?php

require 'vendor/autoload.php';

spl_autoload_register( function( $class_name ) {
  echo "$class_name <br /><br />";
	$file_name = './Controllers/' . $class_name . '.php';
	if( file_exists( $file_name ) ) {
		require_once($file_name);
	}
});

require_once('routes.php');

?>
