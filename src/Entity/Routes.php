<?php namespace Holamanola45\Www\Entity;

use Holamanola45\Www\Entity\Test\TestRoutes;
use Holamanola45\Www\Lib\Router;

class Routes {
    public static function addRoutes(Router $router) {
        TestRoutes::addRoutes($router);
    }
}