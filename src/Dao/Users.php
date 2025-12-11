<?php
namespace App\Dao;

class Users extends Table
{
    public function getByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE userName = :u LIMIT 1");
        $stmt->execute([":u" => $username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($username, $hashedPassword)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (userName, userPassword, userRole)
            VALUES (:u, :p, 'CLIENT')
        ");
        return $stmt->execute([
            ":u" => $username,
            ":p" => $hashedPassword
        ]);
    }
}
