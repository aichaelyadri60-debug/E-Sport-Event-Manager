<?php

class JoueurRepository extends BaseRepository
{
    protected string $table = 'joueur';
    protected string $entityClass = Joueur::class;
    protected string $primaryKey ='personne_id';


public function findAlljoueur(): array
    {
    return $this->pdo->query("
        SELECT p.nom, p.nationalite, j.pseudo ,j.role ,j.valeur_marchande ,j.personne_id
        FROM joueur j
        JOIN personne p ON p.id = j.personne_id
    ")->fetchAll();


    }


    public function findJoueur($id){
        return $this->pdo->query("
        SELECT p.nom, p.nationalite,p.email , j.pseudo ,j.role ,j.valeur_marchande ,j.personne_id
        FROM joueur j
        JOIN personne p ON p.id = j.personne_id
        where p.id =$id
    ")->fetch();

    }




}
