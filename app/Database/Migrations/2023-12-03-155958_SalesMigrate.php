<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SalesMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'saleId' => [
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
            ]
        ]);

        $this->forge->addKey('saleId', true); 
        $this->forge->addForeignKey('userId', 'users', 'userId', 'NO ACTION', 'NO ACTION', "userId_sale_FK");
        $this->forge->addForeignKey('shippingId', 'shipping_details', 'shippingId', 'NO ACTION', 'NO ACTION', "shippingId_sale_FK");
        $this->forge->createTable('sales');
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}
