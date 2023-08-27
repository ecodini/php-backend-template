<?php namespace Holamanola45\Www\Entity\User;
      
use Holamanola45\Www\Lib\DbConnection;
use Holamanola45\Www\Lib\DbService;

class UserService extends DbService {
    function __construct() {
        $conn = new DbConnection();

        parent::__construct('user', $conn);
    }
}