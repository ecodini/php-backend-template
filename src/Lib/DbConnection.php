<?php namespace Holamanola45\Www\Lib;

use PDO;
use Throwable;

class DbConnection {
    private string $dsn;

    private PDO $conn;

    function __construct() {
        $this->dsn = "mysql:host=" . $_ENV["DB_HOST"]. ";dbname=". $_ENV["DB_NAME"]. ";charset=UTF8";

        try {
            $this->conn = new PDO($this->dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"]);
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function close() {
        // garbage collector should kill the PDO connection automatically once there are no references to it.
        unset($conn);
    }

    function __destruct() {
        $this->close();
    }

    public function query(string $sql, array $vars = []): array {
        try {
            $statement = $this->conn->prepare($sql);

            $statement->execute($vars);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}