<?php

class Coach extends BaseEntity{
    #[Column(name: 'personne_id', type: 'INT' ,primaryKey:true)]
    private string $personne_id;
    #[Column(name :'style_coaching' ,type:'VARCHAR')]
    private string $style_coaching ;
    #[Column(name :'annees_experience' ,type:'INT')]
    private int $annees_experience ;
    #[Column(name: 'equipe_id', type: 'INT')]
    private ?int $equipe_id = null;

}