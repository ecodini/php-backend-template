<?php namespace Holamanola45\Www\Lib;

class Db {
    public static function createConnection() {
        echo $_ENV["DB_USER"];
    }
}