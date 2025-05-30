<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingDetails extends Model
{
    protected $table            = 'shipping_details';
    protected $primaryKey       = 'shippingId';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['details'];
}
