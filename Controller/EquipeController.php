<?php

class EquipeController{
    private EquipeRepository $EquipeRepo ;
    private PDO $pdo;

    public function __construct(){
        $this->pdo=Database::getInstance()->getConnection();
        $this->EquipeRepo =new EquipeRepository($this->pdo);
    }

    public function index(){
        $equipes = $this->EquipeRepo->findAll();
        require 'views/layout/Admin/teams/list.php';
    }
    public function show(){
         require "views/layout/Admin/teams/create.php";
        
    }

    public function store(){
        if($_SERVER['REQUEST_METHOD']!== 'POST'){
            die('methode non autorise');
        }
        $equipe =new Equipe();
        $equipe->hydrate([
            'nom'        =>$_POST['nom'],
            'manager'    =>$_POST['manager'],
            'budget'     =>$_POST['budget'],

        ]);

        $this->EquipeRepo->create($equipe);
         header('Location: index.php?controller=equipe&action=index');
        exit;



    }

    public function edit(){
        $id =$_GET['id'];
        $equipe =$this->EquipeRepo->find($id);
        require "views/layout/Admin/teams/edit.php";
    }


    public function update(){
        if($_SERVER['REQUEST_METHOD']  !== 'POST'){
            die('methode non autorise');
        }
        $equipeid =$_GET['id'];
        $equipe =new Equipe();
        $equipe->hydrate([
            'id'        =>$equipeid,
            'nom'       =>$_POST['nom'],
            'manager'   =>$_POST['manager'],
            'budget'    =>$_POST['budget']
        ]);
        $this->EquipeRepo->update($equipe);


        header('Location: index.php?controller=equipe&action=index');
        exit;


    }

    public function delete(){
        $equipeid =$_GET['id'];
        $this->EquipeRepo->delete($equipeid);
        header('Location: index.php?controller=equipe&action=index');
        exit;

    }
}