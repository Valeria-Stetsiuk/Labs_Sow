<?php

namespace app\database;

use app\App;
use app\interfaces\DatabaseConnect;

class ODBC implements DatabaseConnect
{
    private $connection;
    private $query;

    public function __construct()
    {
        try {
            $config = App::getConfig()->getParam('db_pdo');
            $connectionString = sprintf(
                'DRIVER={%s};Server=%s;Database=%s;Port=%s;Types=%s;TrustServerCertificate=yes;',
                'MySQL ODBC 8.2 Unicode Driver',
                $config['host'],
                $config['dbname'],
                $config['port'],
                'Unicode'
            );

            $this->connection = odbc_connect($connectionString, $config['user_name'], $config['password']);

            if (!$this->connection) {
                throw new \Exception("Connection failed");
            }
        } catch (\Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query(string $sql): ODBC
    {
        $this->query = odbc_prepare($this->connection, $sql);
        return $this;
    }

    public function row_array(): array
    {
        odbc_execute($this->query);
        $result = [];
        while ($row = odbc_fetch_array($this->query)) {
            $result[] = $row;
        }
        return $result;
    }


    public function exec(string $sql): void
    {
        // TODO: Implement exec() method.
    }

    public function execTransaction(string $sql, array $prepare = []): void
    {
        // TODO: Implement execTransaction() method.
    }

    public function beginTransaction(): void
    {
        // TODO: Implement beginTransaction() method.
    }

    public function commit(): void
    {
        // TODO: Implement commit() method.
    }

    public function rollBack(): void
    {
        // TODO: Implement rollBack() method.
    }

    public function execTransactions(array $sql_list): void
    {
        // TODO: Implement execTransactions() method.
    }

    public function prepare(string $sql, array $options = []): ODBC
    {
        return $this;
    }
}