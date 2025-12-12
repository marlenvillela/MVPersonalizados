<?php
// 1. Autoload de Composer (NECESARIO para Dotenv).
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Cargar el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad(); // usa safeLoad() para evitar errores si falta algo.

// 3. Autoload interno del framework.
require_once __DIR__ . '/../src/Core/Autoload.php';
\App\Core\Autoload::register();

// 4. Iniciar router.
use App\Core\Router;

$router = new Router();
$router->run();
