<?php

use Luracast\Restler\Restler;
use Luracast\Restler\iAuthenticate;

class Bootstrap {
	
	/**
	 * This method allow dispatch rest services using 'Restler' thirdparty library
	 * Notice: Restler requires PHP >=5.3.2
	 * @param $uri Request URL address
	 **/
	public static function dispatchRestService ($uri) {
		$rest = new Restler(false, true);
		$rest->addAPIClass('Luracast\\Restler\\Resources'); //this creates resources.json
		$rest->setSupportedFormats( 'JsonFormat');
		
		// getting all services class: admin, app, plugin(TODO)
		$restClasses = array ();
		$restClassesList = Bootstrap::rglob( '*', 0, PATH_HOME . 'app' . PATH_SEP .'api' );

		foreach ($restClassesList as $classFile) {
			if (substr( $classFile, -4 ) === '.php') {
				$restClasses[str_replace( '.php', '', basename( $classFile ) )] = $classFile;
			}
		}

		foreach ($restClasses as $key => $classFile) {
			if (! file_exists( $classFile )) {
				unset( $restClasses[$key] );
				continue;
			}

			//load the file, and check if exist the class inside it.
			require_once $classFile;
			$namespace = 'Services_Rest_';
			$className = str_replace( '.php', '', basename( $classFile ) );
			
			// verify if there is an auth class implementing 'iAuthenticate'
			$classNameAuth = $namespace . $className;

			$reflClass = new ReflectionClass( $classNameAuth );
			// $reflClass->implementsInterface( 'iAuthenticate' ) && $namespace == 'Services_Rest_'
			if(false){
				$rest->addAuthenticationClass($classNameAuth); // @see /app/api/Auth.php
			}else{
				$rest->addAPIClass( $classNameAuth );
			}
		}

		//end foreach rest class
		// resolving the class for current request
		$uriPart0 = explode('?', $uri);
    	$uri = isset($uriPart0[0]) ? $uriPart0[0] : $uri;
		$uriPart = explode( '/', $uri );
		$requestedClass = '';
		if (isset( $uriPart[1] )) {
			$requestedClass = ucfirst( $uriPart[1] );
		}

		$namespace = class_exists( 'Services_Rest_' . $requestedClass ) ? 'Services_Rest_' : '';
		// end resolv.

		// to handle a request with "OPTIONS" method
		if (! empty( $namespace ) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
			$reflClass = new ReflectionClass( $namespace . $requestedClass );

			// if the rest class has not a "options" method
			if (! $reflClass->hasMethod( 'options' )) {
				header( 'Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, HEADERS' );
				header( 'Access-Control-Allow-Headers: authorization, content-type' );
				header( "Access-Control-Allow-Credentials", "false" );
				header( 'Access-Control-Max-Age: 60' );
				exit();
			}
		}
		
		// override global REQUEST_URI to pass to Restler library strtolower( $namespace )
		$_SERVER['REQUEST_URI'] = '/' . strtolower($namespace)  . $requestedClass;

		$rest->handle();
	}
	
	/**
	 * Recursive version of glob php standard function
	 *
	 * @param $path path to scan recursively the write permission
	 * @param $flags to notive glob function
	 * @param $pattern pattern to filter some especified files
	 * @return <array> array containing the recursive glob results
	 */
	public static function rglob($pattern = '*', $flags = 0, $path = '')
	{
		$paths = glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
		$files = glob($path.$pattern, $flags);
		foreach ($paths as $path) {
			$files = array_merge($files, Bootstrap::rglob($pattern, $flags, $path));
		}
		return $files;
	}
	
}