<?php namespace Holamanola45\Www\Entity\User;
      
use Holamanola45\Www\Lib\Db\DbConnection;
use Holamanola45\Www\Lib\Db\DbService;

class UserService extends DbService {
    function __construct() {
        $conn = new DbConnection();

        parent::__construct('user', $conn);
    }

    public function findByUsername(string $username) {
        $row = $this->query('
            SELECT * FROM user
            WHERE username = :name LIMIT 1;
        ', array(
            'name' => $username
        ));

        return $row[0];
    }
}