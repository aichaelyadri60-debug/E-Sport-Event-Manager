<?php

#[Attribute(attribute::TARGET_CLASS)]
class Table{
    public function __construct(public string $name){

    }
}