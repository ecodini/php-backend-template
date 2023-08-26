<?php namespace Holamanola45\Www\Entity\Test;

use Holamanola45\Www\Entity\Test\TestController;
use Holamanola45\Www\Lib\Router;

class TestRoutes {
    public static $prefix = '/api/test';

    public static function addRoutes(Router $router) {
        $router->add(self::$prefix. '/lol/([0-9]*)', 'post', TestController::class, 'helloWord');
    }
}