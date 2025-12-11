<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Dao\Transactions;

class TransactionsController extends Controller {

    public function index() {
        $txDao = new Transactions();
        $transactions = $txDao->all();

        $this->render('transactions', [
            'transactions' => $transactions
        ]);
    }
}
