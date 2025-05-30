<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleDetail extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sale_details';
    protected $primaryKey       = 'saleDetailId';
    protected $allowedFields    = ['artItemId', 'saleId'];
}
