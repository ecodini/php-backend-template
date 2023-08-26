<?php namespace Holamanola45\Www\Entity\Test;

use Holamanola45\Www\Lib\Request;
use Holamanola45\Www\Lib\Response;

class TestController
{
    public function helloWord(Request $req, Response $res)
    { 
        $res->status(201);
        $res->toJSON($req->getJSON());
    }
}