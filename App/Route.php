<?php

namespace App;

use App\Controllers\PageNotFound;
use Exception;

/**
 * Class Route
 * @package App
 */
class Route
{
    private $routes;
    private $route = [];
    private $queryParam = [];

    public function __construct()
    {
        $this->loadRoutes();
    }

    /**
     *
     */
    private function loadRoutes()
    {
        $this->routes = require(DOCUMENT_ROOT . '/App/Routes.php');
    }

    /**
     * @param $name
     * @param $pattern
     * @param $parameters
     * @param $controller
     * @param string $action
     */
    public function add($name, $pattern, $parameters, $controller, $action = 'Index')
    {
        $this->routes[strtolower($name)] = [
            'url' => $this->generate($pattern, $parameters),
            'controller' => $controller,
            'action' => $action,
            'parameters' => $parameters,
        ];
    }

    /**
     * @param $name
     * @param array $parameters
     * @return string
     */
    public function generate($name, $parameters = [])
    {
        $strParametrs = '';

        if (count($parameters) == 0) {
            return $name;
        }

        foreach ($parameters as $key => $parameter) {

            $strParametrs .= (empty($strParametrs) ? '' : '&');
            $strParametrs .= is_string($key) ?
                $key . "={{$parameter}}" :
                $parameter . "={{$parameter}}";
        }

        $url = $name . (empty($name) ? '' : '?') . $strParametrs;

        return $url;
    }

    /**
     * @param $name
     * @param array $parameters
     * @return string
     */
    public function generateFull($name, $parameters = [])
    {
        //dd($parameters);
        $strParametrs = $this->generate($name, $parameters);

        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] . '?' . $strParametrs;

        $url = str_replace(['{','}'], '', $url);

        return $url;
    }

    /**
     * @param $uri
     * @throws Exception
     */
    public function get($uri)
    {
        if (!empty($uri)) {

            $pos = strripos($uri, '?');

            if ($pos === false) {

                $uri = '/';

            } else {

                $keyPrime = Null;

                foreach ($_GET as $key => $value) {

                    $pos = strripos($key, '?');

                    if ($pos === false) {

                        if ($keyPrime == Null) {

                            $this->queryParam[$key] = $value;

                        } else {

                            $this->queryParam[$keyPrime][$key] = $value;
                        }

                    } else {

                        $keyArray = explode('?', $key);
                        $keyPrime = $keyArray[0];
                        $this->queryParam[$keyPrime][$keyArray[1]] = $value;

                    }

                }
                $uri = array_keys($this->queryParam)[0];
            }

            $route = $this->getRoute($uri);

            if (empty($route)) {

                header("HTTP/1.0 500 Internal server error");
                $route = $this->getByName('404');

            }

            $this->route['controller'] = ucfirst($route['controller']);

            $this->route['action'] = ucfirst($route['action']);
        }

        $class = '\\App\\Controllers\\' . $this->route['controller'];

        if (array_key_exists('parameters', $route) && is_array($route['parameters'])) {

            foreach ($route['parameters'] as $key => $parameter) {

                if (is_string($key)) {

                    $this->queryParam[$key] = $parameter;

                }

            }

        }

        try {

            $this->route['controller'] = new $class;

        } catch (\Throwable $e) {

            $this->route['controller'] = new PageNotFound();
            $this->route['action'] = 'Index';

        }
    }

    /**
     * @param $strRoute
     * @return mixed
     */
    private function getRoute($strRoute)
    {

        $route = $this->getByName($strRoute);

        if ($route != Null) {

            return $route;

        }

        foreach ($this->routes as $route) {

            if (strcasecmp($strRoute, $route['url']) == 0) {

                return $route;

            } elseif (count($this->queryParam) > 0) {

                $strQuery = '';

                foreach ($this->queryParam as $param => $valueArray) {

                    if (is_array($valueArray)) {

                        $strQuery = $this->generate($param, array_keys($valueArray));

                    } else {

                        $strQuery = $this->generate($param);

                    }
                }

                if (strcasecmp($strQuery, $route['url']) == 0) {

                    return $route;

                }
            }
        }

    }

    /**
     * @param $name
     * @return array
     */
    public function getByName($name)
    {

        $slName = strtolower($name);

        if (array_key_exists(strtolower($slName), $this->routes)) {

            return $this->routes[$slName];

        }

    }

    /**
     *
     */
    public function run()
    {

        $funcname = $this->route['action'];

        if (count($this->queryParam) > 0 &&
            property_exists($this->route['controller'], 'param')) {

            $this->route['controller']->param = $this->queryParam;
            $this->route['controller']->$funcname();

        } else {

            $this->route['controller']->$funcname();

        }

    }

}