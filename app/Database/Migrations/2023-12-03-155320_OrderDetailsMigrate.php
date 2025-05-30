<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderDetailsMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'orderDetailId' => [
                'type' => 'int', 
                'auto_increment' => true,
            ],
            'orderId' => [
                'type' => 'int',
            ],
            'artItemId' => [
                'type' => 'varchar',
                'constraint' => 36
            ]
        ]);

        $this->forge->addKey('orderDetailId', true); 
        $this->forge->addForeignKey('artItemId', 'art_items', 'artItemId', 'NO ACTION', 'NO ACTION', "artItemId_orderDetails_FK");
        $this->forge->addForeignKey('orderId', 'orders', 'orderId', 'NO ACTION', 'NO ACTION', "orderId_orderDetails_FK");
        $this->forge->createTable('order_details');
    }
    
    public function down()
    {
        $this->forge->dropTable('order_details');
    }
}
