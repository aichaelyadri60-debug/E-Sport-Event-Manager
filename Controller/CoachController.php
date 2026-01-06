<?php


class CoachController{
    private PersonneRepository $personneRepo;
    private CoachRepository $coachRepo;
    private PDO $pdo;
    public function __construct(){
        $this->pdo =  Database::getInstance()->getConnection();
        $this->coachRepo =new CoachRepository($this->pdo);
        $this->personneRepo =new PersonneRepository($this->pdo);
    }

    public function index(){
        $coachs = $this->coachRepo->findAllCoach();
        require 'views/layout/Admin/coaches/list.php';
    }

        public function edit(){
        $id =$_GET['id'];
        $coach =$this->coachRepo->findcoach($id);
        require 'views/layout/Admin/coaches/edit.php';
    }

    public function update(){
        if($_SERVER['REQUEST_METHOD'] !=='POST'){
            die('methode non autorise');
        }
        $personneId =$_GET['id'];
        $this->pdo->BeginTransaction();
        try{
            $personne =new Personne();
            $personne->hydrate([
                'id' =>$personneId,
                'nom'          => $_POST['nom'],
                'email'        => $_POST['email'],
                'nationalite'  => $_POST['nationalite']
            ]);

            $this->personneRepo->update($personne);
            $coach =new coach();
            $coach->hydrate([
                'personne_id'      => $personneId,
                'style_coaching' =>$_POST['style_coaching'],
                'annees_experience' =>$_POST['annees_experience']
            ]);

            $this->coachRepo->update($coach);
            $this->pdo->commit();
            header('Location: index.php?controller=coach&action=index');
        exit;

        }catch(Exception $e){
            $this->pdo->rollBack();
            die('erreur :'.$e->getMessage());

        }
    }
    public function delete(){
        $id =$_GET['id'];
        $this->coachRepo->delete($id);
        $this->personneRepo->delete($id);
       header('Location: index.php?controller=coach&action=index');
        exit;
    }
}