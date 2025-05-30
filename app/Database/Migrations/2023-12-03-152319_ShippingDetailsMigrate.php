<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ShippingDetailsMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'shippingId' => [
                'type' => 'int',
                'auto_increment' => true,
            ],

            'details' => [
                'type' => 'text',
            ]
        ]);

        $this->forge->addKey('shippingId', true); 
        $this->forge->createTable('shipping_details');
    }

    public function down()
    {
       $this->forge->dropTable('shipping_details');
    }
}
