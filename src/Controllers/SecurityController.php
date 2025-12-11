<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Users;

class SecurityController extends Controller
{
    public function login()
    {
        // Router ya inicia la sesión

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? "";
            $password = $_POST["password"] ?? "";

            $dao = new Users();
            $user = $dao->getByUsername($username);

            if (!$user) {
                $this->render("security/login", [
                    "error" => "Usuario no encontrado"
                ]);
                return;
            }

            if (!password_verify($password, $user["userPassword"])) {
                $this->render("security/login", [
                    "error" => "Contraseña incorrecta"
                ]);
                return;
            }

            // Guardar sesión del usuario
            $_SESSION["user"] = [
                "id"       => $user["userId"],
                "username" => $user["userName"],
                "role"     => $user["userRole"]
            ];

            header("Location: /");
            exit;
        }

        // Mostrar vista del login
        $this->render("security/login");
    }

    public function logout()
    {
        // Router ya inició sesión, no repetir session_start

        session_destroy();
        header("Location: /?page=security/login");
        exit();
    }

    public function register()
    {
        // Router ya maneja sesión

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? "";
            $password = $_POST["password"] ?? "";

            if (strlen($username) < 3) {
                $this->render("security/register", [
                    "error" => "El usuario debe tener mínimo 3 caracteres"
                ]);
                return;
            }

            if (strlen($password) < 4) {
                $this->render("security/register", [
                    "error" => "La contraseña debe tener mínimo 4 caracteres"
                ]);
                return;
            }

            $dao = new Users();

            if ($dao->getByUsername($username)) {
                $this->render("security/register", [
                    "error" => "El usuario ya existe"
                ]);
                return;
            }

            $dao->create($username, password_hash($password, PASSWORD_DEFAULT));

            header("Location: /?page=security/login");
            exit();
        }

        $this->render("security/register");
    }
}
