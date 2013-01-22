<?php
	define( 'TIME_COOKIE', 604800 );
	
	define( 'APP_NAME', "Framework");      //@TODO Replace by actual website name
	
	require 'config_path.php';
	require 'config_db.php';
	require 'functions.php';

	//Logs ?
	define( 'LOGFILE_PREFIX', APP_NAME ); 
	
	define('URL_DOMAIN', 'http://' . APP_NAME . '/');
	define('URL_SERVEUR', 'http://' . APP_NAME . '/' . ABSOLUTE_WEB );
	define('PAGE_TITLE', APP_NAME );
	define('DEV_EMAIL', 'jsouve@sfsuswe.com' );
	
	define('APP_ACTION', 'fuseaction');