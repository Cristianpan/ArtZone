<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OccupationMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'occupationId' => [
                'type' => 'int', 
                'auto_increment' => true, 
            ],
            'occupationType' => [
                'type' => 'varchar', 
                'constraint' => 30, 
            ]
        ]);
        $this->forge->addKey('occupationId', true);
        $this->forge->createTable('occupations');
    }
    
    public function down()
    {
        $this->forge->dropTable('occupations');
    }
}
