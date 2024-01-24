<?php
header('Content-Type: text/html; charset=UTF-8');
/** Define ABSPATH as this file's directory */
if ( ! defined( 'PATH' ) ) { 
	define( 'PATH', dirname( __FILE__ ) . '/' );
}

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

require_once( PATH . 'config.php' );
require_once( PATH . 'functions.php' );
require_once( PATH . 'framework.php' );

session_start();

checkUserLogin( $_SESSION['id_session'] );
