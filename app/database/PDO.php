<?php
namespace app\database;

use app\interfaces\DatabaseConnect;
use \PDO as Driver;
use app\App;
use \PDOException;

class PDO implements DatabaseConnect
{
    protected Driver $connection;
    protected $query;

    public function __construct()
    {

        try {
            $config = App::getConfig()->getParam('db_pdo');

            $this->connection = new Driver(
                sprintf('mysql:host=%s;dbname=%s;port=%s',$config['host'],$config['dbname'],$config['port']),
                $config['user_name'],
                $config['password']
            );

            $this->connection->setAttribute(Driver::ATTR_ERRMODE, Driver::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query(string $sql): PDO
    {
       $this->query = $this->connection->prepare($sql);
       return $this;
    }

    public function row_array(): array
    {
        $this->query->execute();
        return $this->query->fetchAll(Driver::FETCH_ASSOC);
    }

    public function execute()
    {
        $this->connection->execute();
        return $this;
    }

    public function exec(string $sql): void
    {
        $this->connection->exec($sql);
    }

    public function execTransaction(string $sql, array $prepare = []): void
    {
        try {
            $this->beginTransaction();
            $this->prepare($sql);
            $this->exec($sql);
            $this->commit();
        } catch (\Exception $e){
            $this->rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param array $sql_list ['query','query']
    **/
    public function execTransactions(array $sql_list): void
    {
        try {
            $this->beginTransaction();

            foreach ($sql_list as $item_command) {
                $this->exec($item_command);
            }
            $this->commit();
        } catch (\Exception $e){
            $this->rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    public function prepare(string $sql, array $options = [])
    {
        return $this->connection->prepare($sql, $options);
    }

    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }

    public function commit(): void
    {
        $this->connection->commit();
    }

    public function rollBack(): void
    {
        $this->connection->rollBack();
    }
}

