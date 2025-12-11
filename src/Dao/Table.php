<?php
namespace App\Dao;

class Table {
    protected $pdo;
    public function __construct() {
        // Cargar parametros de conexion desde el archivo parameters.env
        $params = parse_ini_file(__DIR__ . '/../../parameters.env');
        $host = $params['DB_SERVER'];
        $db = $params['DB_DATABASE'];
        $user = $params['DB_USER'];
        $pass = $params['DB_PSWD'];
        $port = $params['DB_PORT'];

        try {
            // Crear la conexion PDO a MySQL
            $this->pdo = new \PDO("mysql:host={$host};dbname={$db};port={$port}", $user, $pass);
            // Activar el modo de errores mediante excepciones
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Mostrar mensaje si ocurre un error al conectar con la base de datos
            echo 'DB connection error: ' . $e->getMessage();
            exit;
        }
    }
}
