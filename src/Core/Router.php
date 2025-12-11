<?php
namespace App\Core;

class Router {

    public function run() {

        session_start();

        // Rutas públicas
        $publicRoutes = [
            "security/login",
            "security/register"
        ];

        // Detectar página
        $page = $_GET['page'] ?? 'home/index';

        // Permitir métodos POST (Paypal los usa)
        $method = $_SERVER['REQUEST_METHOD'];

        // Si no es ruta pública → requiere login
        if (!in_array($page, $publicRoutes)) {
            if (!isset($_SESSION['user'])) {
                // PERMITIR PayPal aun sin login
                if (!str_starts_with($page, "payments/")) {
                    header("Location: /?page=security/login");
                    exit();
                }
            }
        }

        // Separar controlador/acción
        $parts = explode('/', $page);
        $controllerName = ucfirst($parts[0]) . 'Controller';
        $action = $parts[1] ?? 'index';

        $controllerClass = '\\App\\Controllers\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            http_response_code(404);
            echo "Controller not found: $controllerName";
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            echo "Action not found: $action";
            return;
        }

        // Ejecutar método (acepta POST y GET)
        call_user_func([$controller, $action]);
    }
}
