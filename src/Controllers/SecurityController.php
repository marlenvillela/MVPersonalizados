<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Users;

class SecurityController extends Controller
{
    //Mostrar el formulario de login y procesar el login
    public function login()
    {

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
            //Guardar información del usuario en la sesión
            $_SESSION["user"] = [
                "id"       => $user["userId"],
                "username" => $user["userName"],
                "role"     => $user["userRole"]
            ];

            header("Location: /");
            exit;
        }

        $this->render("security/login");
    }
    //Cerrar sesión del usuario
    public function logout()
    {


        session_destroy();
        header("Location: /?page=security/login");
        exit();
    }
    //Mostrar el formulario de registro y procesar el registro
    public function register()
    {


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
