<?php

class Autoloading{
    public static function LoadClass(){
        spl_autoload_register(function($classname){
            $paths =['Attrinutes' ,'config' ,'Controller' ,'Model'];
            foreach($paths as $path){
                $file =$path.$classname.'php';
                if(isset($file)){
                    require_once($file);
                    return ;
                }
                throw new Exception("class $classname introvable .");
            }
        });

    }

}