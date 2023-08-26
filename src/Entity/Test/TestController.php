<?php namespace Holamanola45\Www\Entity\Test;

use Holamanola45\Www\Lib\GenericHttpError;
use Holamanola45\Www\Lib\Request;
use Holamanola45\Www\Lib\Response;
use Throwable;

class TestController
{
    public function helloWorld(Request $req, Response $res) {
        try {
            /* $conn = new DbConnection();

            $cons = $conn->query('DELETE FROM post WHERE id = :id;', array(
                'id' => 2
            ));*/
            
            $res->status(200);

            $res->toXML(array(
                'status' => 200,
                'message' => 'Hello world!'
            ));

        } catch (Throwable $e) {
            GenericHttpError::InternalServerError($res, $e->getMessage());
        }
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