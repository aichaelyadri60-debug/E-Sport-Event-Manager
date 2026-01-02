<?php

abstract class Personne extends BaseEntity{
    #[Column(name :'id' ,type:'INT' ,primaryKey :true )]
    protected ?int $id = null ;
    #[Column(name :'Nom' ,type:'VARCHAR' ,length:50 )]
    protected ?string $Nom;
    #[Column(name :'email' ,type:'VARCHAR' )]
    protected ?string $email ;
    #[Column(name :'Nationalite' ,type:'VARCHAR'  )]
    protected ?string $Nationalite ;

    
}