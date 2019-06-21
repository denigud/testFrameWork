<?php


namespace App;


class Router
{

    public static function getFull($name, $parameters = []){

        return (new Route())->generateFull($name, $parameters);
    }

}