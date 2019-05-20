<?php

class Autoload {

    private static $_directorySource;
    private static $_namespaceApplication;

    private static $_directoryCoreSource = 'core';
    private static $_namespaceCoreApplication = 'Core';

    public static function customAutoload($class) {
        $namespaces = explode('\\', $class);
        $class = str_replace('\\', DIRECTORY_SEPARATOR , $class);
        if($namespaces[0] == self::$_namespaceApplication)  {
            $class = str_replace(self::$_namespaceApplication, self::$_directorySource , $class);
        } else if ($namespaces[0] == self::$_namespaceCoreApplication) {
            $class = str_replace(self::$_namespaceCoreApplication, self::$_directoryCoreSource , $class);
        }

        $path = "../$class.php";


        if(file_exists($path)){
            require $path;
        } else {
            echo '<h1>Arquivo não encontrado</h1> ' . $path;
        }
    }

    public static function registerAutoload($namespaceApplication, $directorySource = "src") {
        self::$_directorySource = $directorySource;
        self::$_namespaceApplication = $namespaceApplication;
        spl_autoload_register(['Autoload','customAutoload']);
    }

}