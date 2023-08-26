<?php namespace Holamanola45\Www\Entity\Test;

use Holamanola45\Www\Lib\Db;
use Holamanola45\Www\Lib\Request;
use Holamanola45\Www\Lib\Response;

class TestController
{
    public function helloWorld(Request $req, Response $res) {
        Db::createConnection();
        
        $res->status(200);

        $res->toXML(array(
            'status' => 200,
            'message' => 'Hello world!'
        ));
    }

    public function postTest(Request $req, Response $res)
    { 
        $xml = $req->getXML();

        $response = [];

        if ($xml->test == 'HOLA') {
            $response = array(
                'status' => 201,
                'message' => 'ke onda'
            );
        }

        $res->status(201);
        $res->toXML($response);
    }
}