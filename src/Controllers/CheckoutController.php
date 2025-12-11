<?php
namespace App\Controllers;

use App\Core\Controller;

class CheckoutController extends Controller {

    public function index() {

        
        $cart = $_SESSION["cart"] ?? [];

        
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item["productPrice"] * $item["qty"];
        }

        
        $this->render("checkout", [
            "cart" => $cart,
            "totalAmount" => $totalAmount
        ]);
    }
}
