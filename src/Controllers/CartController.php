<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Products;

class CartController extends Controller {
    //Mostrar el carrito
    public function index() {
        $cart = $_SESSION["cart"] ?? [];
        $this->render("cart", ["cart" => $cart]);
    }
    //Agregar producto al carrito
    public function add() {

        $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

        if ($id <= 0) {
            header("Location: /?page=products/index");
            exit();
        }

      //Buscar el producto en la base de datos
        $productDao = new Products();
        $product = $productDao->find($id);

        if (!$product) {
            header("Location: /?page=products/index");
            exit();
        }

       
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        
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
    //Eliminar producto del carrito
    public function remove() {

        $id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

        if (isset($_SESSION["cart"][$id])) {
            unset($_SESSION["cart"][$id]);
        }

        header("Location: /?page=checkout/index");
        exit();
    }

}
