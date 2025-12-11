<?php
namespace App\Dao;

class Users extends Table
{
    public function getByUsername($username)
    {
        // Preparar consulta para buscar un usuario especifico
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE userName = :u LIMIT 1");
        // Ejecutar consulta con el nombre de usuario
        $stmt->execute([":u" => $username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($username, $hashedPassword)
    {
         // Consulta para insertar un nuevo usuario
        $stmt = $this->pdo->prepare("
            INSERT INTO users (userName, userPassword, userRole)
            VALUES (:u, :p, 'CLIENT')
        ");
         // Ejecuta la consulta con los parametros enviados
        return $stmt->execute([
            ":u" => $username,
            ":p" => $hashedPassword
        ]);
    }
}
