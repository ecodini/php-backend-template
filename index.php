<?php
require __DIR__ . '/vendor/autoload.php';

use Holamanola45\Www\Lib\Server;
use Holamanola45\Www\Lib\Router;
use Holamanola45\Www\Lib\Request;
use Holamanola45\Www\Lib\Response;
use Holamanola45\Www\Entity\Test\TestController;
use Holamanola45\Www\Entity\Routes;

$router = new Router();

Routes::addRoutes($router);

$router->route();

Server::run();