<?php

namespace App\Models;

use CodeIgniter\Model;

class Sale extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'saleId';
    protected $allowedFields    = ['userId', 'shippingId', 'date'];

    public function getSalesByUserId(string $userId)
    {
        $sales = $this->where('userId', $userId)->findAll();

        foreach ($sales as $key => $sale) {
            $shipping = (new ShippingDetails())->find($sale['shippingId']);
            $sales[$key]['shipping'] = json_decode($shipping['details'], true);
            $saleDetails = (new SaleDetail())
            ->select('sale_details.artItemId, users.userId, art_items.name, image, users.name as userName, lastName, price')
            ->join('art_items', 'art_items.artItemId = sale_details.artItemId')
            ->join('users', 'art_items.userId = users.userId')
            ->where('saleId', $sale['saleId'])
            ->findAll();
            $sales[$key]['artItems'] = $saleDetails;

            $sales[$key]['total'] = array_reduce($saleDetails, function ($carry, $item) {
                return $carry + floatval($item['price']) * 1.1;
            }, 0);
        }
        return $sales;
    }
}
