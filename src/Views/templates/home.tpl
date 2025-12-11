<h1>Regalos únicos para personas especiales</h1>
<p>Catálogo destacado</p>

<div class="product-grid">

<?php foreach ($products as $p): ?>
    <div class="product-card">

        <div class="product-image">
            <img src="<?php echo htmlspecialchars($p['productImgUrl']); ?>" alt="">
        </div>

        <div class="product-info">
            <h3><?php echo htmlspecialchars($p['productName']); ?></h3>
            <p class="description"><?php echo htmlspecialchars($p['productDescription']); ?></p>
            <p class="price">L. <?php echo htmlspecialchars($p['productPrice']); ?></p>

            <div class="actions">
                <a href="/?page=products/view&id=<?php echo $p['productId']; ?>">Ver</a>
                <a href="/?page=cart/add&id=<?php echo $p['productId']; ?>">Agregar</a>
            </div>
        </div>

    </div>
<?php endforeach; ?>

</div>
 