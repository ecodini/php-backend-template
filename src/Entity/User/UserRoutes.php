<?php namespace Holamanola45\Www\Entity\User;

use Holamanola45\Www\Lib\Http\Router;

class UserRoutes {
    public static $prefix = '/api/user';

    public static function addRoutes(Router $router) {
        $router->add(self::$prefix. '', 'get', UserController::class, 'getAllUsers', true);
        $router->add(self::$prefix. '/name/([^/]*$)', 'get', UserController::class, 'getUser', true);
        $router->add(self::$prefix. '/([0-9]*)', 'get', UserController::class, 'getById', true);
    }
}