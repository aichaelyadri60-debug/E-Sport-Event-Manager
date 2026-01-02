<?php

class Coach extends Personne{
    #[Column(name :'style_coaching' ,type:'VARCHAR')]
    private string $style_coaching ;
    #[Column(name :'annees_experience' ,type:'INT')]
    private int $annees_experience ;

}