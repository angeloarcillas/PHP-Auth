<?php

namespace App\Models;

use \Exception;
use \App\Database\QueryBuilder;

abstract class Model extends QueryBuilder
{
    /**
     * SQL table
     */
    protected ?string $table = null;

    /**
     * Valid columns
     */
    protected array $fillable = [];

    /**
     * Where key
     */
    protected string $key = 'id';

    public function __construct()
    {
        if (!isset($this->table)) {
            throw new Exception("There is no table defined.");
        }
    }

    /**
     * Execute INSERT sql | CREATE
     * 
     * @param array $params
     * @return bool
     */
    public function insert(array $params): bool
    {
        // filter request with $fillable
        $params = $this->filter($params);

        // set column names
        $columns = implode(',', array_keys($params));

        // set column values placeholder
        $values = trim(str_repeat('?,', count($params)), ',');

        // sql statement
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            $columns,
            $values
        );

        return $this->rawQuery($sql, $params);
    }

    /**
     * Execute UPDATE sql | UPDATE
     * 
     * @param string|int $id
     * @param array $params
     * @param null|string $key
     * @return bool
     */
    public function update(
        string|int $id,
        array $params,
        ?string $key = null
    ): bool {
        // filter request with $fillable
        $params = $this->filter($params);

        // set column names
        $keys = array_keys($params);

        // set column values placeholder
        $set = trim(implode('=?,', $keys) . '=?', ',');

        // check if user defined a key
        $key = $key ? [$key => $id] : [$this->key => $id];

        // sql statement
        $sql = sprintf(
            'UPDATE %s SET %s WHERE %s = ?',
            $this->table,
            $set,
            key($key) // get $key key
        );

        // append $key value
        $params[] = current($key);

        return $this->rawQuery($sql, $params);
    }

    /**
     * Execute DELETE sql | DELETE
     * 
     * @param string|int $id
     * @param null|string $key
     * @return bool
     */
    public function delete(string|int $id, ?string $key = null): bool
    {
        // sql statement
        $sql = sprintf(
            'DELETE FROM %s WHERE %s = ?',
            $this->table,
            // check if user defined a key
            $key ?? $this->key
        );

        return $this->rawQuery(sql: $sql, params: [$id]);
    }

    /**
     * Select 1 row from database | READ
     *
     * @param string|int $id
     * @param null|string $key
     * @param null|string $table
     * @return mixed
     */
    public function select(
        string|int $id,
        ?string $key = null,
        ?string $table = null
    ): mixed {
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ? LIMIT 1",
            // check if user defined a table
            $table ?? $this->table,
            // check if user defined a key
            $key ?? $this->key
        );

        return $this->rawSelect($sql, [$id]);
    }

    /**
     * Select all rows from database | READ
     *
     * @param null|string $table
     * @param array $columns
     * @return array
     */
    public function selectAll(array $columns = ['*'], ?string $table = null): array
    {
        $sql = sprintf(
            "SELECT %s FROM %s",
            // set column names
            implode(',', $columns),
            // check if user defined a table
            $table ?? $this->table
        );

        return $this->rawSelectAll($sql);
    }

    /**
     * Test count param of query
     */
    public function testRawCount(string $sql): int
    {
        return $this->rawCount(sql: $sql);
    }

    /**
     * Filter $request with $this->fillable
     * Returns all request that can be filled
     * 
     * @param array $params
     * @return array
     */
    protected function filter(array $params): array
    {
        return array_filter(
            // request
            $params,

            // arrow function | return fillable requests
            fn ($_, $key) => in_array($key, $this->fillable),

            // use array keys & values
            ARRAY_FILTER_USE_BOTH
        );
    }
}
