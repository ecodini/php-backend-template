<?php namespace Holamanola45\Www\Lib;

class XMLHelper {
    public static function arrayToXML($array, &$xml) {
        foreach($array as $key => $value) {               
            if(is_array($value)) {            
                if(!is_numeric($key)){
                    $subnode = $xml->addChild($key);
                    self::arrayToXML($value, $subnode);
                } else {
                    self::arrayToXML($value, $subnode);
                }
            } else {
                $xml->addChild($key, $value);
            }
        }
    }
}