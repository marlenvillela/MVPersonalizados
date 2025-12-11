<h1>Historial de Transacciones</h1>

<table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order ID</th>
            <th>Payer ID</th>
            <th>Monto</th>
            <th>Moneda</th>
            <th>Status</th>
            <th>Fecha</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($transactions as $t): ?>
        <tr>
            <td><?php echo $t['transactionId']; ?></td>
            <td><?php echo htmlspecialchars($t['orderId']); ?></td>
            <td><?php echo htmlspecialchars($t['payerId'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($t['amount']); ?></td>
            <td><?php echo htmlspecialchars($t['currency']); ?></td>
            <td><?php echo htmlspecialchars($t['status']); ?></td>
            <td><?php echo htmlspecialchars($t['created_at']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
