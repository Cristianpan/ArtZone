<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'orderId' => [
                'type' => 'int',
                'auto_increment' => true
            ],
            'userId' => [
                'type' => 'varchar',
                'constraint' => 36
            ], 
            'shippingId' => [
                'type' => 'int',
            ],
            'date' => [
                'type' => 'datetime'
            ],
            'total' => [
                'type' => 'decimal',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('orderId', true); 
        $this->forge->addForeignKey('userId', 'users', 'userId', 'NO ACTION', 'NO ACTION', "userId_order_FK");
        $this->forge->addForeignKey('shippingId', 'shipping_details', 'shippingId', 'NO ACTION', 'NO ACTION', "shippingId_order_FK");
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
