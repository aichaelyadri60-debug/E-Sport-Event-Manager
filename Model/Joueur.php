<?php

class Joueur extends BaseEntity {

    #[Column(name: 'personne_id', type: 'INT' ,primaryKey:true)]
    private string $personne_id;

    #[Column(name: 'pseudo', type: 'VARCHAR')]
    private string $pseudo;

    #[Column(name: 'role', type: 'VARCHAR')]
    private string $role;

    #[Column(name: 'valeur_marchande', type: 'DECIMAL', m: 12, d: 2)]
    private float $valeur_marchande;

    #[Column(name: 'equipe_id', type: 'INT')]
    private ?int $equipe_id =null;
}
