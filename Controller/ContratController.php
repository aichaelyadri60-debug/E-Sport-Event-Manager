<?php

class ContratController{
    private ContratRepository $ContratRepo ;
    private PersonneRepository $PersonneRepo ;
    private EquipeRepository $EquipeRepo ;
    private PDO $pdo;

    public function __construct(){
        $this->pdo=Database::getInstance()->getConnection();
        $this->ContratRepo =new ContratRepository($this->pdo);
        $this->PersonneRepo =new PersonneRepository($this->pdo);
        $this->EquipeRepo =new EquipeRepository($this->pdo);
    }

    public function index(){
        $Contrats = $this->ContratRepo->findAllContrat();
        require 'views/layout/Admin/Contrats/list.php';
    }
    public function show(){
        $personnesDisponibles = $this->PersonneRepo->findpersonnesDisponibles();
        $AllEquipes =$this->EquipeRepo->findAll();
         require "views/layout/Admin/Contrats/create.php";
        
    }


    public function details(){
    if (!isset($_GET['id'])) {
        die('Contrat introuvable');
    }

    $id = (int) $_GET['id'];
    $contrat = $this->ContratRepo->findContratDetails($id);

    if (!$contrat) {
        die('Contrat introuvable');
    }

    require 'views/layout/Admin/Contrats/show.php';
    }

    public function getTypePersonne(){
        $personneId =$_GET['id'];
        $typePersonne =$this->PersonneRepo->getTypePersonne($personneId);
        header('Content-Type: application/json');
        return json_encode(['type'=>$typePersonne]);

    }
    public function store()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Methode non autorisee');
    }

    $this->pdo->beginTransaction();

    try {
        $personneId = (int) $_POST['personne_id'];
        $equipeId   = (int) $_POST['equipe_id'];
        $salaire    = (float) $_POST['salaire'];
        $clause     = (float) $_POST['clause_rachat'];
        $bonus      =(float) $_POST['bonus'];

        if ($salaire <= 0 || $clause <= 0) {
            throw new Exception("Données financières invalides");
        }

        $typePersonne =$this->PersonneRepo->getTypePersonne($personneId);
        if ($typePersonne === 'coach') {
            $bonus = 0; 
        }

        $budgetEquipe = $this->EquipeRepo->getBudget($equipeId);
        $coutAnnuel   =  $salaire + $bonus;

        if ($budgetEquipe < $coutAnnuel) {
            throw new Exception("Budget insuffisant pour ce contrat");
        }
        
        $dateDebut =new DateTime();
        $contrat = new Contrat();
        $contrat->hydrate([
            'personne_id'   => $personneId,
            'equipe_id'     => $equipeId,
            'salaire'       => $salaire,
            'clause_rachat' => $clause,
            'date_debut'    => $dateDebut->format('Y-m-d'),
            'bonus'         =>$bonus,
        ]);

        $this->ContratRepo->create($contrat);

        $this->pdo->commit();

        header('Location: index.php?controller=contrat&action=index');
        exit;

    } catch (Exception $e) {
        $this->pdo->rollBack();
        die('Erreur : ' . $e->getMessage());
    }
}

    

    
}