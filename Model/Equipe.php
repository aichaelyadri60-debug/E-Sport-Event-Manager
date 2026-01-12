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

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getBudget(): float
    {
        return $this->budget;
    }

    public function getManager(): string
    {
        return $this->manager;
    }
}