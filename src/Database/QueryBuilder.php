<?php

namespace App\Database;

use \Exception;
use \App\Database\Connection;

abstract class QueryBuilder extends Connection
{
    /**
     * Valid fetch type
     */
    protected array $validFetchType = ['fetch', 'fetchAll'];

    /**
     * Raw SQL query from database
     *
     * @param string $sql
     * @param array $params
     * @return bool
     */
    protected function rawQuery(string $sql, array $params = []): bool
    {
        return $this->query(sql: $sql, params: $params);
    }

    /**
     * Raw SQL select query from database
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    protected function rawSelect(string $sql, array $params = []): mixed
    {
        return $this->query(sql: $sql, params: $params, fetchType: 'fetch');
    }

    /**
     * Raw SQL select all query from database
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    protected function rawSelectAll(string $sql, array $params = []): array
    {
        return $this->query(sql: $sql, params: $params, fetchType: 'fetchAll');
    }

    /**
     * Raw SQL row count query from database
     *
     * @param string $sql
     * @param array $params
     * @return int
     */
    protected function rawCount(string $sql, array $params = []): int
    {
        return $this->query(sql: $sql, params: $params, count: true);
    }

    /**
     * Execute query
     * 
     * @param string $sql
     * @param array $params
     * @param null|string $fetchType
     * @param bool $count
     * @return mixed
     */
    private function query(
        string $sql,
        array $params = [],
        ?string $fetchType = null,
        bool $count = false
    ): mixed {
        // prepare sql
        $stmt = $this->connection()->prepare($sql);

        // get parameters
        $params = array_values($params);

        // if count, return the number of row selected
        if ($count) {
            $stmt->execute($params);
            return $stmt->rowCount();
        }

        // if no fetch type then execute
        if (!$fetchType) return $stmt->execute($params);

        // if invalid fetch type, throw error
        if (!in_array($fetchType, $this->validFetchType)) {
            throw new Exception("Type \"{$fetchType}\" is an invalid Fetch Type.");
        }

        // execute sql
        $stmt->execute($params);

        // fetch from database
        $result = $stmt->{$fetchType}();


        // return fetched result
        return $result;
    }

    // Establish connection
    private function connection()
    {
        return parent::connect(CONFIG['database']);
    }
}
