<?php namespace Holamanola45\Www\Lib\Db;

class QueryGenerator {
    public static function parseAttributes(array $query_params) {
        $attributes = NULL;

        if (isset($query_params['attributes'])) {
            $attributes = implode(', ', $query_params['attributes']);
        } else {
            $attributes = '*';
        }

        return $attributes;
    }

    public static function  generateWhere(array $query_params) {
        $where = NULL;

        if (isset($query_params['where'])) {
            $where = 'WHERE ';

            $conds = array();

            foreach($query_params['where'] as $col => $val) {
                $conds[] = $col . " = :" . $col;
            }

            $where = $where . implode(', ', $conds);
        }

        return $where;
    }
}