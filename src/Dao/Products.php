<?php
namespace App\Dao;

class Products extends Table {

    public function all() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM products LIMIT 100");
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE productId = :id LIMIT 1");
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
