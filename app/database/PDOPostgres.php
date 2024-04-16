<?php


namespace app\database;


use app\App;
use app\interfaces\DatabaseConnect;
use \PDO as Driver;

class PDOPostgres extends PDO implements DatabaseConnect
{
    public function __construct()
    {
        try {
            $config = App::getConfig()->getParam('db_pg');

            $this->connection = new Driver(
                sprintf('pgsql:host=%s;dbname=%s;port=%s',$config['host'],$config['dbname'],$config['port']),
                $config['user_name'],
                $config['password']
            );

            $this->connection->setAttribute(Driver::ATTR_ERRMODE, Driver::ERRMODE_EXCEPTION);

        } catch (\Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


}