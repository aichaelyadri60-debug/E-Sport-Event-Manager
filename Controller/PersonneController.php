<?php

class PersonneController
{
    private PersonneRepository $personneRepo;
    private JoueurRepository $joueurRepo;
    private CoachRepository $coachRepo;
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->personneRepo = new PersonneRepository($pdo);
        $this->joueurRepo   = new JoueurRepository($pdo);
        $this->coachRepo    = new CoachRepository($pdo);
    }

    public function show(){
        require "views/layout/Admin/persons/create.php";
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Methode non autorise');
        }

        $this->pdo->beginTransaction();

        try {
            $personne = new Personne();

            $personne->hydrate([
                'nom'          => $_POST['nom'],
                'email'        => $_POST['email'],
                'nationalite'  => $_POST['nationalite']
            ]);

            $this->personneRepo->create($personne);

            $personneId = (int)$this->pdo->lastInsertId();

            if ($_POST['type'] === 'joueur') {

                $joueur = new Joueur();

                $joueur->hydrate([
                    'personne_id'      => $personneId,
                    'pseudo'           => $_POST['pseudo'],
                    'role'             => $_POST['role'],
                    'valeur_marchande' => $_POST['valeur_marchande'],
                ]);

                $this->joueurRepo->create($joueur);

            } elseif ($_POST['type'] === 'coach') {

                $coach = new Coach();

                $coach->hydrate([
                    'personne_id'       => $personneId,
                    'style_coaching'    => $_POST['style_coaching'],
                    'annees_experience' => $_POST['annees_experience'],
                ]);

                $this->coachRepo->create($coach);
            }
            $this->pdo->commit();

            header('Location: index.php?success=1');
            exit;

        } catch (Exception $e) {

            $this->pdo->rollBack();
            die('Erreur : ' . $e->getMessage());
        }
    }
}
