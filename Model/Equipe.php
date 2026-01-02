<?php 

class Equipe extends BaseEntity{

     #[Column(name :'id' ,type:'INT' ,primaryKey :true )]
    private ?int $id =null;
    #[Column(name :'nom' ,type:'VARCHAR')]
    private string $nom ;
    #[Column(name :'Nom' ,type:'VARCHAR')]
    private float $budget;
    #[Column(name :'Nom' ,type:'VARCHAR')]
    private string $manager;
}