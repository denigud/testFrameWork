<?php

function dd(){
    echo '<pre>';
    $args = func_get_args();
    foreach ($args as $key=>$arg) {
        var_dump($key);
        var_dump($arg);
        echo '<br>';
    }

    die();
}

function dwd(){
    echo '<pre>';
    $args = func_get_args();
    foreach ($args as $key=>$arg) {
        var_dump($key);
        var_dump($arg);
        echo '<br>';
    }
}
