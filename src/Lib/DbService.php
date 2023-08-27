<?php namespace Holamanola45\Www\Lib;

abstract class DbService {
    private DbConnection $db_conn;

    private string $table_name;

    function __construct(string $table_name, DbConnection $db_conn) {
        $this->table_name = $table_name;
        $this->db_conn = $db_conn;
    }

    function __destruct() {
        $this->db_conn->close();
    }

    public function query(string $sql, array $vars = []): array {
        return $this->db_conn->query($sql, $vars);
    }

    public function getTotalRows() {
        $rows = $this->query('
            SELECT COUNT(id) as count FROM ' . $this->table_name . '
        ');

        return $rows[0]['count'];
    }

    public function findById(int $id) {
        $rows = $this->query('
            SELECT * FROM ' . $this->table_name . '
            WHERE id = :id;
        ', array('id' => $id));

        if (count($rows) == 0) {
            return NULL;
        }

        return $rows[0];
    }

    public function findAll(int $limit, int $offset) {
        $rows = $this->query('
            SELECT * FROM ' . $this->table_name . '
            LIMIT :limit OFFSET :offset;
        ', array(
            'limit' => $limit,
            'offset' => $offset
        ));

        return $rows;
    }

    public function deleteById(int $id) {
        $rows = $this->query('
            DELETE FROM ' . $this->table_name . '
            WHERE id = :id;
        ', array('id' => $id));

        if (count($rows) == 0) {
            return NULL;
        }

        return $rows[0];
    }
}