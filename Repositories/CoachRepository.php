<?php

class CoachRepository extends BaseRepository
{
    protected string $table = 'coach';
    protected string $entityClass = Coach::class;
    protected string $primaryKey ='personne_id';

    public function findAllCoach(): array
    {
        return $this->pdo->query("
            SELECT 
                p.nom,
                p.nationalite,
                c.style_coaching,
                c.annees_experience,
                c.personne_id
            FROM coach c
            JOIN personne p ON p.id = c.personne_id
        ")->fetchAll();
    }

    public function findcoach($id){
        return $this->pdo->query("
         SELECT 
                p.nom,
                p.email,
                p.nationalite,
                c.style_coaching,
                c.annees_experience,
                c.personne_id
            FROM coach c
            JOIN personne p ON p.id = c.personne_id
        where p.id =$id
    ")->fetch();

    }
    
}
