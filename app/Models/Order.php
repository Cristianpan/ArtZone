<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class Order extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'orderId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['userId', 'shippingId', 'total', 'date'];

    public function createOrder(array $data)
    {
        try {
            $this->db->transStart();
            $shippingId = (new ShippingDetails())->insert(['details' => json_encode($data['details'])]);

            $costTotal = array_reduce($data['items'], function ($carry, $item) {
                return $carry + floatval($item['price']) * 1.1;
            }, 0);

            $order = [
                'shippingId' => $shippingId,
                'total' => $costTotal,
                'userId' => session()->get('user')['userId'],
                'date' => (new DateTime())->format("Y-m-d H:i:s")
            ];

            $orderId =  $this->insert($order);

            $orders = array_map(function ($item) use ($orderId) {
                return [
                    'orderId' => $orderId,
                    'artItemId' => $item['artItemId'],
                ];
            }, $data['items']);

            (new OrderDetail())->insertBatch($orders);

            $sales = [];

            foreach ($data['items'] as $item) {
                $sales[$item['userId']][] = $item['artItemId'];
            }

            foreach ($sales as $userId => $itemsSold) {
                $sale = [
                    'shippingId' => $shippingId,
                    'userId' => $userId,
                    'date' => (new DateTime())->format("Y-m-d H:i:s")
                ];
                $saleId = (new Sale())->insert($sale);

                $auxArray = array_map(function ($item) use ($saleId) {
                    return [
                        'saleId' => $saleId,
                        'artItemId' => $item,
                    ];
                }, $itemsSold);

                (new SaleDetail())->insertBatch($auxArray);
            }

            $this->db->transCommit();
        } catch (\Throwable $th) {
            $this->db->transRollback();
            throw $th;
        }
    }

    public function getOrderByUserId(string $userId)
    {
        $orders = $this->where('userId', $userId)->findAll();

        foreach ($orders as $key => $order) {
            $shipping = (new ShippingDetails())->find($order['shippingId']);
            $orders[$key]['shipping'] = json_decode($shipping['details'], true);
            $orderDetails = (new OrderDetail())
            ->select('order_details.artItemId, users.userId, art_items.name, image, users.name as userName, lastName, price')
            ->join('art_items', 'art_items.artItemId = order_details.artItemId')
            ->join('users', 'art_items.userId = users.userId')
            ->where('orderId', $order['orderId'])
            ->findAll();
            $orders[$key]['artItems'] = $orderDetails;

        }


        return $orders;
    }
}
