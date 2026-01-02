<?php
#[table(name:'Contrat')]
class Contrat extends BaseEntity {

    #[Column(name: 'id', type: 'INT', primaryKey: true)]
    private int $id;

    #[Column(name: 'personne_id', type: 'INT', foreignKey: true)]
    private int $personne_id;

    #[Column(name: 'equipe_id', type: 'INT', foreignKey: true)]
    private int $equipe_id;

    #[Column(name: 'salaire', type: 'DECIMAL', m: 10, d: 2)]
    private float $salaire;

    #[Column(name: 'clause_rachat', type: 'DECIMAL', m: 12, d: 2)]
    private float $clause_rachat;

    #[Column(name: 'date_debut', type: 'DATE')]
    private DateTime $date_debut;

    #[Column(name: 'date_fin', type: 'DATE')]
    private DateTime $date_fin;
}
