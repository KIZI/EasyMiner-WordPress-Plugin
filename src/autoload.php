<?php

try
{
    spl_autoload_register(function($class){
        $file = __DIR__.'/';
        $file .= str_replace(['\\'], DIRECTORY_SEPARATOR, $class).'.php';
        if(file_exists($file)){
            require_once $file;
        }
    });
}
catch (\Exception $exception)
{
    wp_die($exception->getMessage());
}
