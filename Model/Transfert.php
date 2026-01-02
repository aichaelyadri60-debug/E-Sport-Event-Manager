<?php 

class Transfert extends BaseEntity {
     #[Column(name :'id' ,type:'INT' ,primaryKey :true )]
     private ?int $id =null;
     #[Column(name :'personne_id' ,type:'INT' ,foreignKey :true )]
     private ?int $personne_id ;
     #[Column(name :'equipe_depart' ,type:'INT' ,foreignKey :true )]
     private ?int $equipe_depart ;
     #[Column(name :'equipe_arrivee' ,type:'INT' ,foreignKey :true )]
     private ?int $equipe_arrivee ;
     #[Column(name :'reference' ,type:'VARCHAR')]
     private string $reference;
     #[Column(name :'montant' ,type:'DECIMAL' ,m:12 ,d:2)]
     private float $montant;
     #[Column(name :'statut' ,type:'VARCHAR')]
    private string $statut;
     #[Column(name :'date_transfert' ,type:'TIMESTAMP')]
    private ?DateTime $date_transfert =null;
}