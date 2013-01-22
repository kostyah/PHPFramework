<?php
	/**
	 * Contains all path for navigating within the app
	 */

define('ABSOLUTE_WEB', $_SERVER['DOCUMENT_ROOT']."/");
define('ABSOLUTE_INC', $_SERVER['DOCUMENT_ROOT']."Framework/");

// If we want to navigate over the www/ folder 
// go to /log or /tmp
// for example
define('APPLICATION_PATH', ABSOLUTE_INC.'../');

//Includes folder
	define('INCLUDES', ABSOLUTE_WEB.'includes/');
	define('INCLUDES_INC', ABSOLUTE_INC.'includes/');
	
	define('CLASS_PATH', INCLUDES_INC.'class/');
	define('DB_CLASS_PATH', CLASS_PATH.'db/');
	define('LIB_CLASS_PATH', CLASS_PATH.'lib/');
	define('RENDERER_CLASS_PATH', CLASS_PATH.'renderer/');

//Layouts folder
	define('LAYOUTS', ABSOLUTE_WEB.'layouts/');
	define('LAYOUTS_INC', ABSOLUTE_INC.'layouts/');
	
	define('TEMPLATES', LAYOUTS.'templates/');
	define('TEMPLATES_INC', LAYOUTS_INC.'templates/');
	
	define('AJAX_REQUESTS', LAYOUTS.'ajax_requests/');
	define('AJAX_REQUESTS_INC', LAYOUTS_INC.'ajax_requests/');
	
	define('MODULES', LAYOUTS.'modules/');
	define('MODULES_INC', LAYOUTS_INC.'modules/');
	
//@TODO Logs folder ?

define('LOG', ABSOLUTE_WEB.'logs/');
define('LOG_INC', ABSOLUTE_INC.'logs/');
?>