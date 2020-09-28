<?php
namespace Core\Database;

class QueryBuilder extends Connection
{
    protected ?object $conn;

    /**
     * make database connection
     */
    public function __construct(array $config)
    {
        $this->conn = parent::make($config);
    }

    /**
     * query from database
     *
     * @param string $sql
     * @param array $params
     */
    public function query(string $sql, array $params = []): bool
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * query fetch all from database
     *
     * @param string $sql
     * @param array $params
     */
    public function querySelectAll(string $sql, array $params = []): ?object
    {
        $stmt = $this->conn->prepare($sql);
        $params = (array) $params;
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * query for fetch 1 from database
     *
     * @param string $sql
     * @param array $params
     */
    public function querySelect(string $sql, array $params = []): ?object
    {
        $stmt = $this->conn->prepare($sql);
        $params = (array) $params;
        $stmt->execute($params);

        if($stmt->rowCount() !== 1) {
            return null;
        }

        return $stmt->fetch();
    }

    /**
     * Select all from database
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $stmt = $this->conn->prepare("SELECT * FROM ?");
        $stmt->execute([$table]);

        return $stmt->fetchAll();
    }

    /**
     * select from database
     *
     * @param string $table
     * @param array $params
     */
    public function select($table, array $params = ['*'])
    {
        $sql = sprintf(
            "SELECT %s FROM {$table}",
            implode(",", $params)
        );

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function count($table): int
    {
        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
