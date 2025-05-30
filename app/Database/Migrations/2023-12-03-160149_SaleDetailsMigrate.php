<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SaleDetailsMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'saleDetailId' => [
                'type' => 'int', 
                'auto_increment' => true,
            ],
            'saleId' => [
                'type' => 'int',
            ],
            'artItemId' => [
                'type' => 'varchar',
                'constraint' => 36
            ]
        ]);

        $this->forge->addKey('saleDetailId', true); 
        $this->forge->addForeignKey('artItemId', 'art_items', 'artItemId', 'NO ACTION', 'NO ACTION', "artItemId_saleDetails_FK");
        $this->forge->addForeignKey('saleId', 'sales', 'saleId', 'NO ACTION', 'NO ACTION', "orderId_saleDetails_FK");
        $this->forge->createTable('sale_details');
    }

    public function down()
    {
        $this->forge->dropTable('sale_details');
    }
}
