<?php 

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column{
    public function __construct(public string $name ,
    public string $type ,
    public int $length =255 ,
    public bool $primaryKey =false ,
    public bool $foreignKey =false ,
    public int $m =10 ,
    public int $d =2){

    }
}