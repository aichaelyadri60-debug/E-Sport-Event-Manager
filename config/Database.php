<?php
class Database{

    private PDO $pdo;
    private static ?Database $instance=null;
    private string  $servername ='localhost';
    private string  $username='root' ;
    private string  $password ='aicha123' ;
    private string $dbname ='ApexMercato';

    private function __construct(){
        $this->pdo =new PDO("mysql:host={$this->servername};dbname:{$this->dbname}" ,$this->username ,$this->password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE ,PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance():Database{
        if(!self::$instance){
            self::$instance =new Database ;
        }
        return self::$instance;
    }

        public function getConnection(): PDO
    {
        return $this->pdo;
    }
} 