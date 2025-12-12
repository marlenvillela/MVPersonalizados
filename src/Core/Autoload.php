<?php
namespace App\Core;

class Autoload {
    public static function register() {
        spl_autoload_register(function($class) {
            // Prefijo que deben tener las clases para que este autoload las cargue
            $prefix = 'App\\';
            $base_dir = __DIR__ . '/../';
            
            if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
                return;
            }
           
            $relative = substr($class, strlen($prefix));
            $file = $base_dir . str_replace('\\', '/', $relative) . '.php';
              // Si el archivo existe entonces lo requerimos
            if (file_exists($file)) {
                require $file;
            }
        });
    }
}
