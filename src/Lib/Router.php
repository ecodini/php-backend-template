<?php namespace Holamanola45\Www\Lib;

use Exception;
use Holamanola45\Www\Lib\GenericHttpError;

class Router
{
    private $routes = array();

    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        return self::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        return self::on($route, $callback);
    }

    public static function on($regex, $cb_array)
    {
        $params = $_SERVER['REQUEST_URI'];

        if (substr($params, -1) == '/') {
            $params = rtrim($params, '/');
        }

        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            array_shift($matches);

            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            $cb = array(new $cb_array['class'](), $cb_array['func']);

            
            $cb(new Request($params), new Response());

            return true;
        }

        return false;
    }

    public function add($path, $method, $controller, $func) {
        $this->routes[] = array(
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "func" => $func
        );
    }

    public function route() {
        try {
            foreach ($this->routes as &$value) {             
                $test = call_user_func(
                    'Holamanola45\Www\Lib\Router::'.$value["method"], 
                    $value['path'], 
                    array(
                        "class" => $value['controller'], 
                        "func" => $value['func']
                    )
                );

                if ($test) {
                    return;
                }
            }

            $res = new Response();
            GenericHttpError::NotFoundError($res);
        } catch (Exception $e) {
            $res = new Response();
            GenericHttpError::InternalServerError($res, $e->getMessage());
        }
    }
}