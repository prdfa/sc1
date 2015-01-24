<?php
$config = dirname(__FILE__) . '/config.php';
require_once( "Social/Auth.php" );

try{
    $socialAuth = new Social_Auth( $config );
    // You can give network name for specific logout. e.g facebook, twitter
    $socialAuth->logout();
    Social_Auth::session()->deleteByKey( "SA_USER" );
    $socialAuth->redirect( "login.php" );
} catch( Exception $ex ) {
    echo "Error occured: " . $ex->getMessage();
}