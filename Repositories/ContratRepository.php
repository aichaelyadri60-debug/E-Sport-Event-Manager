<?php


class ContratRepository extends BaseRepository{
    protected string $table ='contrat';
    protected string $entityClass=Contrat::class;

    public function findAllContrat(){
        $stmt =$this->pdo->query('SELECT p.nom AS nom_personne,
            p.typee AS type_personne, e.nom AS nom_equipe, c.salaire, c.date_debut, c.date_fin ,c.id
            FROM contrat c
            JOIN personne p ON c.personne_id = p.id
            JOIN equipe e ON c.equipe_id = e.id;
        ');
        return $stmt->fetchAll();
    }


   public function findContratDetails(int $id)
    {
        $sql = "
            SELECT 
                c.id AS contrat_id,
                p.nom AS nom_personne,
                p.typee AS type_personne,
                e.nom AS nom_equipe,
                c.salaire,
                c.clause_rachat,
                c.date_debut,
                c.date_fin
            FROM contrat c
            JOIN personne p ON c.personne_id = p.id
            JOIN equipe e ON c.equipe_id = e.id
            WHERE c.id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


public function findEquipeActuelleByPersonne(int $id): ?array
{
   $sql = 'SELECT e.id, e.nom 
    FROM contrat c
    JOIN equipe e ON e.id = c.equipe_id
    join personne p on p.id =c.personne_id
    WHERE c.personne_id = :id
      AND (c.date_fin IS NULL OR c.date_fin >= CURDATE())
    ORDER BY c.date_debut DESC
    LIMIT 1
';


    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch() ?: null;
}


public function closeContratByPersonne(int $personneId): bool
{
    $sql = "UPDATE contrat
        SET date_fin = CURDATE()
        WHERE personne_id = :personne_id
          AND (date_fin IS NULL OR date_fin >= CURDATE())
    ";

    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute(['personne_id' => $personneId]);
}





}