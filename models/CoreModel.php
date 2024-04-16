<?php


namespace models;
use app\database\ODBC;
use \app\database\PDO;
use app\database\PDOPostgres;
use app\interfaces\DatabaseConnect;

abstract class CoreModel
{

    protected DatabaseConnect $db;

    public function __construct(string $type = 'pdo')
    {
        $this->setType($type);
    }

    public function setType(string $type_connection): CoreModel
    {
        switch ($type_connection){
            case 'pdo':
            case 'JDBC':
                $this->db = new PDO();
                break;
            case 'odbc':
            case 'ODBC':
                $this->db = new ODBC();
                break;
            case 'pdo_postgres':
            case 'Postgres':
            case 'postgres':
                $this->db = new PDOPostgres();
                break;
            default:
                $this->db = new PDO();
        }
        return $this;
    }

    abstract protected  function setNameTable(): string;





}