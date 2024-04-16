<?php


namespace app\database;

use app\App;
use app\interfaces\DatabaseConnect;

class MsDatabase implements DatabaseConnect
{
    private $connect;
    public function __construct()
    {
        $conf = App::getConfig()->getParam('ms_db');
        $serverName = $conf['server_name']; // Имя сервера SQL Server
        $connectionOptions =[
            "Database" => $conf['database'], // Имя базы данных
            "Uid" => $conf['uid'], // Имя пользователя
            "PWD" => $conf['pwd'], // Пароль пользователя
            "MultipleActiveResultSets" => $conf['multi_pleactive_resultsets'], // Разрешение нескольких активных результатов
            "ConnectionPooling" => $conf['connection_pooling'], // Использование пула соединений
            "Encrypt" => $conf['encrypt'],
            "TrustServerCertificate" => $conf['trust_server_certificate'] // Доверие сертификату сервера
        ];

        $this->connect = sqlsrv_connect($serverName, $connectionOptions);

        if (!$this->connect) {
            throw new \Exception(sqlsrv_errors());
        }
    }

    public function query(string $sql)
    {
        return $this;
    }

    public function row_array(): array
    {
        return [];
    }
}