<?php namespace Holamanola45\Www\Domain;

use DateTime;

class User {
    function __construct($array) {
        foreach($array as $key=>$value) {
            $this->$key = $value;
        }
    }

    public int $id;

    public string $username;

    public string $password;

    public DateTime $created_at;

    public string $created_by_ip;

    public string $last_login_ip;

    public DateTime $activated_at;
}