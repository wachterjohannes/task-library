<?php

class Autoloader
{
    static public function loader($className)
    {
        $filename = __DIR__ . "/../src/" . str_replace('\\', '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

spl_autoload_register('Autoloader::loader');

include_once __DIR__ . "/ReverseWorker.php";
