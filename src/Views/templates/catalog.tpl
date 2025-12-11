<h1>Catálogo</h1>

<div style="display:flex;gap:16px;flex-wrap:wrap;">

<?php foreach($products as $p): ?>
    <div style="width:30%;background:#fff;padding:12px;border-radius:6px;
        box-shadow:0 2px 6px rgba(0,0,0,0.08);margin-bottom:16px;">

        <img src="<?php echo htmlspecialchars($p['productImgUrl']); ?>"
             style="width:100%;height:160px;object-fit:cover;border-radius:6px;">

        <h3><?php echo htmlspecialchars($p['productName']); ?></h3>
        <p><?php echo htmlspecialchars($p['productDescription']); ?></p>
        <p><strong>L. <?php echo htmlspecialchars($p['productPrice']); ?></strong></p>

        <a href="/?page=products/view&id=<?php echo $p['productId']; ?>">Ver</a> |
        <a href="/?page=cart/add&id=<?php echo $p['productId']; ?>">Agregar</a>
    </div>
<?php endforeach; ?>

</div>
