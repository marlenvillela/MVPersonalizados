<?php
namespace App\Controllers;

use App\Core\Controller;

class CheckoutController extends Controller {

    public function index() {

        // Si el carrito no existe, enviarlo vacío
        $cart = $_SESSION["cart"] ?? [];

        // Calcular total
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item["productPrice"] * $item["qty"];
        }

        // Renderizar vista con la variable que PayPal necesita
        $this->render("checkout", [
            "cart" => $cart,
            "totalAmount" => $totalAmount
        ]);
    }
}
