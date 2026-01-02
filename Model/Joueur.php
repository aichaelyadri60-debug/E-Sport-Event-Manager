<?php

class Joueur extends Personne {

    #[Column(name: 'pseudo', type: 'VARCHAR')]
    private string $pseudo;

    #[Column(name: 'role', type: 'VARCHAR')]
    private string $role;

    #[Column(name: 'valeur_marchande', type: 'DECIMAL', m: 12, d: 2)]
    private float $valeur_marchande;
}
