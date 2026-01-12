<?php 
class JoueurController{
    private PersonneRepository $personneRepo;
    private JoueurRepository $joueurRepo;
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->personneRepo = new PersonneRepository($pdo);
        $this->joueurRepo   = new JoueurRepository($pdo);
    }

    public function index()
    {
        $joueurs = $this->joueurRepo->findAlljoueur();
        require 'views/layout/Admin/players/List.php';
    }

    public function edit(){
        $id =$_GET['id'];
        $joueur =$this->joueurRepo->findJoueur($id);
        require 'views/layout/Admin/players/edit.php';
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] !=='POST'){
            die('methode non autorise');
        }
        $personneId = $_GET['id'];
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
             $joueur = new Joueur();

                $joueur->hydrate([
                    'personne_id'      => $personneId,
                    'pseudo'           => $_POST['pseudo'],
                    'role'             => $_POST['role'],
                    'valeur_marchande' => $_POST['valeur_marchande'],
                ]);
                $this->joueurRepo->update($joueur);


                 $this->pdo->commit();

        header('Location: index.php?controller=joueur&action=index');
        exit;

        }catch(Exception $e){
            $this->pdo->rollBack();
            die('erreur :'.$e->getMessage());
        }

    }
    public function delete(){
        $id =$_GET['id'];
        $this->joueurRepo->delete($id);
        $this->personneRepo->delete($id);
        header('Location: index.php?controller=joueur&action=index');
        exit;
    }

}