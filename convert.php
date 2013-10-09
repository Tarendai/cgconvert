<?php

if ( php_sapi_name() !== 'cli' ) {
	die;
}

if ( file_exists( 'vendor/autoload.php' ) ) {
	require 'vendor/autoload.php';
}

$app = new \Tomjn\Cgconvert\ConvertApplication();
$app->run();
