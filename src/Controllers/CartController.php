<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Products;

class CartController extends Controller {

    public function index() {
        $cart = $_SESSION["cart"] ?? [];
        $this->render("cart", ["cart" => $cart]);
    }

    public function add() {

        $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

        if ($id <= 0) {
            header("Location: /?page=products/index");
            exit();
        }

        // Obtener producto desde BD
        $productDao = new Products();
        $product = $productDao->find($id);

        if (!$product) {
            header("Location: /?page=products/index");
            exit();
        }

        // Inicializar carrito si no existe
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        // Si es producto nuevo → guardarlo con imagen incluida
        if (!isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id] = [
                "productId" => $product["productId"],
                "productName" => $product["productName"],
                "productPrice" => $product["productPrice"],
                "productImage" => $product["productImgUrl"], 
                "qty" => 1
            ];
        } else {
            $_SESSION["cart"][$id]["qty"] += 1;
        }

        header("Location: /?page=cart/index");
        exit();
    }

    public function remove() {

        $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

        if (isset($_SESSION["cart"][$id])) {
            unset($_SESSION["cart"][$id]);
        }

        header("Location: /?page=checkout/index");
        exit();
    }

}
