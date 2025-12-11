<?php
namespace App\Dao;

class Transactions extends Table {
    public function create($data) {
        // Consulta preparada para insertar una nueva transaccion
        $sql = "INSERT INTO transactions (orderId, payerId, userId, amount, currency, status, raw_response)
                VALUES (:orderId, :payerId, :userId, :amount, :currency, :status, :raw)";
        // Ejecuta la consulta con los parametros proporcionados        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':orderId' => $data['orderId'],
            ':payerId' => $data['payerId'] ?? null,
            ':userId'  => $data['userId'] ?? null,
            ':amount'  => $data['amount'],
            ':currency' => $data['currency'] ?? 'USD',
            ':status' => $data['status'],
            ':raw' => json_encode($data['raw'] ?? []),
        ]);
        return $this->pdo->lastInsertId();
    }

    public function all() {
        // Seleccionar todas las transacciones, ordenadas por fecha de creacion
        $stmt = $this->pdo->query("SELECT * FROM transactions ORDER BY created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByOrderId($orderId) {
        // Consulta preparada para buscar por orderId
        $stmt = $this->pdo->prepare("SELECT * FROM transactions WHERE orderId = :oid LIMIT 1");
        // Ejecuta consulta con el parametro proporcionado
        $stmt->execute([':oid' => $orderId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
