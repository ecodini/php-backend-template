<?php namespace Holamanola45\Www\Lib\Db;

use Exception;

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

    public function findById(int $id, array $query_params) {
        $attributes = QueryGenerator::parseAttributes($query_params);

        $rows = $this->query('
            SELECT ' . $attributes .' FROM ' . $this->table_name . '
            WHERE id = :id LIMIT 1;
        ', array('id' => $id));

        if (count($rows) == 0) {
            return NULL;
        }

        return $rows[0];
    }

    public function findAll(array $query_params) {
        $attributes = QueryGenerator::parseAttributes($query_params);

        $where = QueryGenerator::generateWhere($query_params);

        $rows = 'SELECT ' . $attributes .' FROM ' . $this->table_name;

        $limit_offset = '
            LIMIT ' . $query_params['limit'] . ' OFFSET ' . $query_params['offset'] . ';
        ';

        if (isset($where)) {
            $rows = $rows . ' ' . $where . ' ';

            return $this->query($rows . $limit_offset, $query_params['where']);
        } else {
            return $this->query($rows . $limit_offset);
        }
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

    public function deleteAll(array $query_params, bool $force = false) {
        $where = QueryGenerator::generateWhere($query_params);

        $rows = NULL;

        if (isset($where)) {
            $rows = $this->query('DELETE FROM ' . $this->table_name . ' ' . $where, $query_params["where"]);
        } else if (!$force) {
            throw new Exception('Delete from without where detected! Use force flag to force delete. WARNING: This will delete ALL rows!');
        } else {
            $rows = $this->query('DELETE FROM ' . $this->table_name);
        }

        if (count($rows) == 0) {
            return NULL;
        }

        return $rows[0];
    }
}