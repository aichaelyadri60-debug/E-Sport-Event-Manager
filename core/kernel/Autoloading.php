<?php

class Autoloading
{
    public static function LoadClass()
    {
        spl_autoload_register(function ($classname) {

            $paths = [
                'Attributes/',
                'config/',
                'Controller/',
                'Model/',
                'Repositories/'
            ];

            foreach ($paths as $path) {
                $file = $path . $classname . '.php';

                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }

            throw new Exception("Classe $classname introuvable");
        });
    }
}
