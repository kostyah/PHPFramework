<?php
 /*
  * Autoload classes
  */

function __autoload( $className ){
	//Searching in /includes
	$foldersList = array( CLASS_PATH, RENDERER_CLASS_PATH, DB_CLASS_PATH, LIB_CLASS_PATH );
	$file = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
	//Browsing folders
	foreach( $foldersList as $repertoire ) {
		if( is_file( $repertoire.$file ) ) {
			require_once $repertoire.$file;
			return;
		}
	}
	
	throw new Exception("Error, can't load {".$className."}");
}

?>