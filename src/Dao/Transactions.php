<?php
namespace App\Dao;

class Transactions extends Table {
    public function create($data) {

        $sql = "INSERT INTO transactions (orderId, payerId, userId, amount, currency, status, raw_response)
                VALUES (:orderId, :payerId, :userId, :amount, :currency, :status, :raw)";
     
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

        $stmt = $this->pdo->query("SELECT * FROM transactions ORDER BY created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByOrderId($orderId) {

        $stmt = $this->pdo->prepare("SELECT * FROM transactions WHERE orderId = :oid LIMIT 1");

        $stmt->execute([':oid' => $orderId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
