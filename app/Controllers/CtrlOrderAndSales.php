<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Order;
use App\Models\Sale;

class CtrlOrderAndSales extends BaseController
{
    public function viewOrder(String $userId)
    {
        $order = (new Order())->getOrderByUserId($userId); 

        return view('pages/orderAndSale/orders', ['orders' => $order]);
    }
    public function viewSale(String $userId)
    {
        $sale = (new Sale())->getSalesByUserId($userId); 
        return view('pages/orderAndSale/sales', ['orders' => $sale]);
    }
}
