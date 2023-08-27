<?php namespace Holamanola45\Www\Lib;

use Holamanola45\Www\Lib\XMLHelper;
use SimpleXMLElement;

class Response
{
    private $status = 200;

    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
    
    public function toJSON($data = [])
    {
        http_response_code($this->status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function toXML($data = []) {
        http_response_code($this->status);
        header('Content-Type: application/xml');

        $data['status'] = $this->status;

        $xml = XMLHelper::arrayToXML($data);
        echo $xml->asXML();
    }
}