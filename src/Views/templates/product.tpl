<h1><?php echo htmlspecialchars($product['productName']); ?></h1>
<img src="<?php echo htmlspecialchars($product['productImgUrl']); ?>" style="width:320px;height:220px;object-fit:cover;">
<p><?php echo htmlspecialchars($product['productDescription']); ?></p>
<p><strong>L. <?php echo htmlspecialchars($product['productPrice']); ?></strong></p>
<a href="/?page=cart/add&id=<?php echo $product['productId']; ?>">Agregar al carrito</a>
