<?php

class Database
{
    private PDO $pdo;
    private static ?Database $instance = null;

    private string $servername = 'localhost';
    private string $username = 'root';
    private string $password = 'aicha123';
    private string $dbname = 'ApexMercato';

    private function __construct()
    {
        $dsn = "mysql:host={$this->servername};dbname={$this->dbname};charset=utf8";

        $this->pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    public static function getInstance(): Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
