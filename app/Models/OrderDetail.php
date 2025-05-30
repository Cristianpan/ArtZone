<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetail extends Model
{
    protected $table            = 'order_details';
    protected $primaryKey       = 'orderDetailId';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['orderId', 'artItemId'];
}
