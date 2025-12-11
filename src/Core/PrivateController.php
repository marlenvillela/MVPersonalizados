<?php
namespace App\Core;

class PrivateController extends Controller {
    protected function requireLogin() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /?page=security/login');
            exit;
        }
    }
}
