<h2>Carrito de Compras</h2>

<style>
.cart-table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 10px;
}
.cart-table th {
    background: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}
.cart-table td {
    padding: 10px;
    text-align: center;
}
.cart-img {
    width: 70px;
    height: 70px;
    border-radius: 5px;
    object-fit: cover;
}
.delete-btn {
    background: crimson;
    color: #fff;
    padding: 6px 12px;
    border-radius: 5px;
    text-decoration: none;
}
</style>

<table class="cart-table">
    <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th>Acciones</th>
    </tr>

    <?php 
    $total = 0; 
    foreach ($cart as $item): 
        $sub = $item['productPrice'] * $item['qty'];
        $total += $sub;
    ?>
    <tr>
        <td><img src="/public/imgs/<?php echo $item['productImage']; ?>" class="cart-img"></td>
        <td><?php echo $item['productName']; ?></td>
        <td>$<?php echo $item['productPrice']; ?></td>
        <td><?php echo $item['qty']; ?></td>
        <td>$<?php echo number_format($sub, 2); ?></td>
        <td>
            <a href="/?page=cart/remove&id=<?php echo $item['productId']; ?>" class="delete-btn">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="total-box">
    <h3>Total: $<?php echo number_format($total, 2); ?></h3>
</div>

<a href="/?page=checkout/index" class="btn btn-primary">Finalizar Compra</a>
