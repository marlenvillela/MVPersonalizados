<?php
namespace App\Dao;

class Table {
    protected $pdo;
    public function __construct() {
        // Basic PDO connection using parameters.env (very minimal)
        $params = parse_ini_file(__DIR__ . '/../../parameters.env');
        $host = $params['DB_SERVER'];
        $db = $params['DB_DATABASE'];
        $user = $params['DB_USER'];
        $pass = $params['DB_PSWD'];
        $port = $params['DB_PORT'];

        try {
            $this->pdo = new \PDO("mysql:host={$host};dbname={$db};port={$port}", $user, $pass);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // For skeleton, we show a simple message
            echo 'DB connection error: ' . $e->getMessage();
            exit;
        }
    }
}
