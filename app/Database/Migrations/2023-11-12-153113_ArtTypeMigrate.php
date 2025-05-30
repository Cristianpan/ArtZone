<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ArtTypeMigrate extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'artTypeId' => [
                'type' => 'int', 
                'auto_increment' => true
            ], 
            'artType' => [
                'type' => 'varchar', 
                'constraint' => 30,
            ], 
        ]); 

        $this->forge->addKey('artTypeId', true); 
        $this->forge->createTable('art_types');
    }

    public function down()
    {
        $this->forge->dropTable('art_types');
    }
}
