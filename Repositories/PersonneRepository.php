<?php


class PersonneRepository extends BaseRepository{
    protected string $table ='personne';
    protected string $entityClass=Personne::class;


    public function getTypePersonne($id){
        $stmt =$this->pdo->prepare("SELECT typee  from personne where id =:id");
        $stmt->execute(['id' =>$id]);
        return $stmt->fetchColumn();
    }

    public function findpersonnesDisponibles(){
        $stmt =$this->pdo->query("SELECT p.id, p.nom FROM personne p
           LEFT JOIN contrat c ON c.personne_id = p.id
           WHERE c.id IS NULL;
        ");

        return $stmt->fetchAll();

    }
    

    public function findPersonneWithContrat(){
        $stmt =$this->pdo->query( " SELECT p.nom  ,p.id from contrat c 
            join personne p on p.id =c.personne_id WHERE c.date_fin IS NULL OR c.date_fin >= CURDATE() ");
        return $stmt->fetchAll();
    }



    public function getValeurMarchande($id){
        $sql ="SELECT valeur_marchande from joueur where personne_id =:id";
        $stmt =$this->pdo->prepare($sql);
        $stmt->execute(['id' =>$id]);
        return $stmt->fetchColumn();

    }



}