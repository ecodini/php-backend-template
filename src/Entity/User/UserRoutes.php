<?php namespace Holamanola45\Www\Entity\User;

use Holamanola45\Www\Lib\Router;

class UserRoutes {
    public static $prefix = '/api/user';

    public static function addRoutes(Router $router) {
        $router->add(self::$prefix. '', 'get', UserController::class, 'getAllUsers');
    }
}