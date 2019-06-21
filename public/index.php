<?php

define("DOCUMENT_ROOT", dirname(__DIR__));

require DOCUMENT_ROOT . '/App/autoload.php';

require DOCUMENT_ROOT . '/App/debug.php';

//echo '<pre>';
//var_dump($_SERVER);
//echo '<pre>';
//die();

try {

    $ControllerInstance = new \App\Route();
    $ControllerInstance->add('page5', 'text', ['page'=>5], 'Text');
    $ControllerInstance->add('page4', 'text', ['page', 'r'=>3], 'Text');
    $ControllerInstance->add('post', 'text', ['page','r'], 'Text');

    //$ControllerInstance->generateFull('text', ['page','r']);

    $ControllerInstance->get($_SERVER['REQUEST_URI']);

} catch(\Throwable $e) {

    header("HTTP/1.0 500 Internal server error");
    echo "Controller initialization fails:";
    echo $e->getMessage();
    exit;

}

$ControllerInstance->run();





