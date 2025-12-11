<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Products;

// Controlador para gestionar productos
class ProductsController extends Controller {
    public function index() {
        $dao = new Products();
        $products = $dao->all();
        $this->render('catalog', ['products' => $products]);
    }
    // Vista de un producto específico
    public function view() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $dao = new Products();
        $all = $dao->all();
        $item = null;
        foreach ($all as $p) {
            if ($p['productId'] == $id) { $item = $p; break; }
        }
        if (!$item) {
            echo 'Producto no encontrado';
            return;
        }
        $this->render('product', ['product' => $item]);
    }
}
