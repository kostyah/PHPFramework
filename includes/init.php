<?php
	
	session_cache_expire(480);
	error_reporting( E_ALL ^ E_DEPRECATED ); // All errors except deprecated
	ini_set( 'session.gc_maxlifetime', 28800 );	//8h
	session_start();
	
	setlocale( LC_TIME , "EN_usa.UTF-8");
	header('Content-type: text/html; charset=UTF-8');

	require_once( "config.php" );
	require_once( "config_db.php" );
	require_once( "functions.php" );
	
?>