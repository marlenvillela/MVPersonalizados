<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AZiafcVYYVB5jwDS78dHccsVd5fTA-Cce3327kyR67kaBQRpvB0gOs1YbprSm6bQ6veQ2HyVT4ilcLcD&currency=USD"></script>

<h2 class="title">Finalizar Compra</h2>

<style>
.checkout-table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
}
.checkout-table th {
    background: #333;
    color: white;
    padding: 12px;
    text-align: center;
}
.checkout-table td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
}
.checkout-img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
}
.delete-btn {
    background: #e63946;
    color: white;
    padding: 7px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}
.delete-btn:hover {
    background: #b71c1c;
}
.total-box {
    width: 90%;
    margin: 20px auto;
    text-align: right;
    font-size: 22px;
    font-weight: bold;
}
.paypal-buttons {
    width: 90%;
    margin: 20px auto;
    text-align: center;
}
</style>

<table class="checkout-table">
    <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($cart as $item): ?>
    <tr>
        <td><img src="<?php echo $item['productImage']; ?>" class="checkout-img"></td>
        <td><?php echo htmlspecialchars($item['productName']); ?></td>
        <td>$<?php echo htmlspecialchars($item['productPrice']); ?></td>
        <td><?php echo htmlspecialchars($item['qty']); ?></td>
        <td>$<?php echo number_format($item['productPrice'] * $item['qty'], 2); ?></td>
        <td><a href="/?page=cart/remove&id=<?php echo $item['productId']; ?>" class="delete-btn">Eliminar</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="total-box">
    Total a pagar: $<?php echo htmlspecialchars($totalAmount); ?>
</div>

<div id="paypal-button-container" class="paypal-buttons"></div>

<script>
const totalAmount = "<?php echo htmlspecialchars($totalAmount ?? '0'); ?>";

paypal.Buttons({

    style: { layout: 'vertical', color: 'gold', shape: 'rect', label: 'paypal' },

    createOrder: function(data, actions) {
        return fetch('/?page=payments/createOrder', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ total: totalAmount })
        })
        .then(res => res.json())
        .then(order => order.id);
    },

    onApprove: function(data, actions) {
        return fetch('/?page=payments/captureOrder', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ orderID: data.orderID })
        })
        .then(res => res.json())
        .then(resp => {
            alert("Pago realizado con éxito 🎉");
            window.location.href = "/?page=transactions";
        });
    },

    onCancel: () => alert("Pago cancelado"),
    onError: err => alert("Error en PayPal")

}).render('#paypal-button-container');
</script>
