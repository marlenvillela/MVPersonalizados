<?php
namespace App\Dao;

class Products extends Table {

    public function all() {
        try {
            // Ejecuta la consulta para obtener hasta un limite de 100 productos
            $stmt = $this->pdo->query("SELECT * FROM products LIMIT 100");
            // Devuelve todos los resultados como un arreglo asociativo
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function find($id) {
        // Prepara la consulta con un parametro para seguridad
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE productId = :id LIMIT 1");
        // Ejecuta la consulta pasando el ID como parametro
        $stmt->execute([":id" => $id]);
        // Devuelve el resultado como un arreglo asociativo
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
