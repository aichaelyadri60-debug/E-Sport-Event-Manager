<?php


class EquipeRepository extends BaseRepository{
    protected string $table ='equipe';
    protected string $entityClass=Equipe::class;

    public function getBudget($id){
        $stmt =$this->pdo->prepare('SELECT budget from equipe where id=:id ');
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchColumn();
    }



    public function decreaseBudget(int $equipeId, float $montant): void
{
    if ($montant <= 0) {
        throw new Exception("Montant invalide pour diminution du budget");
    }

    $sql = "
        UPDATE equipe
        SET budget = budget - :montant
        WHERE id = :id
          AND budget >= :montant
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'montant' => $montant,
        'id'      => $equipeId
    ]);

    if ($stmt->rowCount() === 0) {
        throw new Exception("Budget insuffisant ou equipe introuvable");
    }
}

public function increaseBudget(int $equipeId, float $montant): void
{
    if ($montant <= 0) {
        throw new Exception("Montant invalide pour augmentation du budget");
    }
    $sql = "
        UPDATE equipe
        SET budget = budget + :montant
        WHERE id = :id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'montant' => $montant,
        'id'      => $equipeId
    ]);
    if ($stmt->rowCount() === 0) {
        throw new Exception("equipe introuvable");
    }
}

}