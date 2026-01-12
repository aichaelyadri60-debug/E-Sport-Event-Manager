<?php 
require_once "core/kernel/FinancialEngine.php";

class TransfertController{
    private transfertRepository $transfertRepo ;
    private PersonneRepository $PersonneRepo;
    private ContratRepository $ContratRepo;
    private EquipeRepository $EquipeRepo;

    private PDO $pdo;

    public function __construct(){
        $this->pdo=Database::getInstance()->getConnection();
        $this->transfertRepo =new TransfertRepository($this->pdo);
        $this->PersonneRepo =new PersonneRepository($this->pdo);
        $this->ContratRepo =new ContratRepository($this->pdo);
        $this->EquipeRepo =new EquipeRepository($this->pdo);
    }
     public function index(){
        $transferts = $this->transfertRepo->findAll();
        require "views/layout/Admin/transferts/list.php";
    }
    public function create(){
        $personnes =$this->PersonneRepo->findPersonneWithContrat();
        $equipes=$this->EquipeRepo->findAll();
         require "views/layout/Admin/transferts/create.php";
    }
public function getEquipeByPersonne()
{
    header('Content-Type: application/json');

    if (!isset($_GET['id'])) {
        echo json_encode(['error' => 'ID manquant']);
        return;
    }

    $id = (int) $_GET['id'];

    $equipe = $this->ContratRepo->findEquipeActuelleByPersonne($id);
    $type   = $this->PersonneRepo->getTypePersonne($id);

    if (!$equipe || !$type) {
        echo json_encode(['error' => 'Donnees introuvables']);
        return;
    }

$montant = 0;

if ($type === 'joueur') {
    $valeurMarchande = $this->PersonneRepo->getValeurMarchande($id);

if ($valeurMarchande === false || $valeurMarchande === null) {
    echo json_encode(['error' => 'Valeur marchande introuvable']);
    return;
}


    $montant = FinancialEngine::calculateTotal((float)$valeurMarchande);
}


    echo json_encode([
        'type'    => $type,
        'equipe'  => $equipe,
        'montant' => $montant
    ]);
}


public function store()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die('Méthode non autorisée');
    }

    try {
        $this->pdo->beginTransaction();

        $personneId    = (int) $_POST['personne_id'];
        $equipeDepart  = (int) $_POST['equipe_depart'];
        $equipeArrivee = (int) $_POST['equipe_arrivee'];
        $statut        = $_POST['statut'];
        $reference     = $_POST['reference'];

        if ($equipeDepart === $equipeArrivee) {
            throw new Exception("Équipe de départ et d’arrivée identiques");
        }

        $type = $this->PersonneRepo->getTypePersonne($personneId);
        if (!$type) {
            throw new Exception("Type de personne introuvable");
        }

        $montant = 0;

        if ($type === 'joueur') {
            $marketValue = $this->PersonneRepo->getValeurMarchande($personneId);
            $budget      = $this->EquipeRepo->getBudget($equipeArrivee);

            $montant = FinancialEngine::checkBudget($marketValue, $budget);
        }

        $transfert = new Transfert();
        $transfert->hydrate([
            'reference'      => $reference,
            'personne_id'    => $personneId,
            'equipe_depart'  => $equipeDepart,
            'equipe_arrivee' => $equipeArrivee,
            'montant'        => $montant,
            'statut'         => $statut
        ]);

        $this->transfertRepo->create($transfert);

        $this->ContratRepo->closeCurrentContrat($personneId);

        $dateDebut = new DateTime();

        $salaire = 0;
        $bonus   = 0;
        $clause  = null;

        if ($type === 'joueur') {
            $salaire = $montant * 0.1;
            $bonus   = $montant * 0.05;
            $clause  = $montant;
        } else { 
            $salaire = 3000; 
        }

        $contrat = new Contrat();
        $contrat->hydrate([
            'personne_id'   => $personneId,
            'equipe_id'     => $equipeArrivee,
            'salaire'       => $salaire,
            'clause_rachat' => $clause,
            'date_debut'    => $dateDebut->format('Y-m-d'),
            'bonus'         => $bonus,
        ]);

        $this->ContratRepo->create($contrat);

        if ($type === 'joueur') {
            $this->EquipeRepo->decreaseBudget($equipeArrivee, $montant);
            $this->EquipeRepo->increaseBudget($equipeDepart, $montant);
        }

        $this->pdo->commit();

        header("Location: index.php?controller=transfert&action=index");
        exit;

    } catch (Throwable $e) {
        $this->pdo->rollBack();
        die("Erreur transfert : " . $e->getMessage());
    }
}


}
