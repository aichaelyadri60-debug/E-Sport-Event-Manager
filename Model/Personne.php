<?php
 class Personne extends BaseEntity{
    #[Column(name :'id' ,type:'INT' ,primaryKey :true )]
    protected ?int $id = null ;
    #[Column(name :'nom' ,type:'VARCHAR' ,length:50 )]
    protected ?string $nom =null;
    #[Column(name :'email' ,type:'VARCHAR' )]
    protected ?string $email =null ;
    #[Column(name :'nationalite' ,type:'VARCHAR'  )]
    protected ?string $nationalite =null;

    
}