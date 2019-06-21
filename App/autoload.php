<?php

    spl_autoload_register(function ($className){

    $class2File = "/".trim(str_replace("\\", "/", $className), "/");

    $classPath = realpath(DOCUMENT_ROOT. $class2File. '.php');
    if(empty($classPath)) {
        throw new \Exception("Class ".$className." file not found");
    }

    require_once $classPath;

    if(!class_exists($className)) {
        header("HTTP/1.0 404 Not found");
        throw new \Exception("Class ".$className." not found");
    }

});
