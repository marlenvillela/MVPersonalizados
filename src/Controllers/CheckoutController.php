<?php
namespace App\Controllers;

use App\Core\Controller;
// Hecho arreglo listo
class CheckoutController extends Controller {
    //Mostrar el resumen del checkout
    public function index() {

        
        $cart = $_SESSION["cart"] ?? [];

        
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item["productPrice"] * $item["qty"];
        }

        //Renderizar la vista de checkout
        $this->render("checkout", [
            "cart" => $cart,
            "totalAmount" => $totalAmount
        ]);
    }
}
