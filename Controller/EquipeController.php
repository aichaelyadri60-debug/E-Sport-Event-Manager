<?php

class EquipeController{
    private EquipeRepository $EquipeRepo ;
    private PDO $pdo;

    public function __construct(){
        $this->pdo=Database::getInstance()->getConnection();
        $this->EquipeRepo =new EquipeRepository($this->pdo);
    }

    public function index(){
        $equipes 
    }
}