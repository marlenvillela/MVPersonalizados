<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Products;

class HomeController extends Controller {

    public function index() {

        // Parte de marlen
        // Juan Favor hacer las correciones que te dije de tu parte
        $productsDao = new Products();
        $products = $productsDao->all();

        $this->render('home', ['products' => $products]);
    }
}
