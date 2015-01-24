<?php
$originalConfig = realpath( dirname( __FILE__ ) )  . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
$templateConfig = realpath( dirname( __FILE__ ) )  . DIRECTORY_SEPARATOR . 'config.template.php';

if ( file_exists( $originalConfig ) ) {
    $config = require_once( $originalConfig );
} else {
    $config = require_once( $templateConfig );
}

echo json_encode($config);