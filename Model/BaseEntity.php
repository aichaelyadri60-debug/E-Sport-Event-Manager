<?php

abstract class BaseEntity{
    public function Hydrate(array $data){
        $ref =new ReflectionClass($this);
        foreach($data as $key =>$value){
            if($ref->hasProperty($key)){
                $prop =$ref->getProperty($key);
                $prop->setAccessible(true);
                $prop->setValue($this ,$value);
            }
        }

    }
}
