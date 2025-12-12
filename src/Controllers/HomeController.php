<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Products;

class HomeController extends Controller {
    //Mostrar la página de inicio
    public function index() {       
        $productsDao = new Products();
        $products = $productsDao->all();

        $this->render('home', ['products' => $products]);
    }
}
