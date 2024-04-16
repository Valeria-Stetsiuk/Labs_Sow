<?php


namespace app\interfaces;


interface DatabaseConnect
{
    public function __construct();

    /**
     * @param string $sql
    **/
    public function query(string $sql);

    /**
     * @return array
    **/
    public function row_array(): array;

    /**
     * @param string $sql
     * @return void
    **/
    public function exec(string $sql): void;

    /**
     * @param string $sql
     * @return void
    **/
    public function execTransaction(string $sql, array $prepare = []): void;

    /**
     * @return void
    **/
    public function beginTransaction(): void;

    /**
     * @return void
    **/
    public function commit(): void;

    /**
     * @return void
    **/
    public function rollBack(): void;

    /**
     * @param array $sql_list
     * @param array $prepare = []
    **/
    public function execTransactions(array $sql_list): void;

    public function prepare(string $sql, array $options = []);

}