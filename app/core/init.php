<?php

if(!isset($_SESSION)){
    session_start();
}


$GLOBALS['config'] = array (
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'evoter'
    ),
    'remember' => array(
        'cookie_name'=> 'hash',
        'cookie_expiry' => 604800
    ),

    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )

);

spl_autoload_register(function($class)
{
    //require_once '../model/'. $class . '.php';
    require_once (__DIR__ . '/../model/' . $class . '.php');
});

?>