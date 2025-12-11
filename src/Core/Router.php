<?php
namespace App\Core;

class Router {

    public function run() {

        session_start();


        $publicRoutes = [
            "security/login",
            "security/register"
        ];


        $page = $_GET['page'] ?? 'home/index';


        $method = $_SERVER['REQUEST_METHOD'];


        if (!in_array($page, $publicRoutes)) {
            if (!isset($_SESSION['user'])) {

                if (!str_starts_with($page, "payments/")) {
                    header("Location: /?page=security/login");
                    exit();
                }
            }
        }


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


        call_user_func([$controller, $action]);
    }
}
