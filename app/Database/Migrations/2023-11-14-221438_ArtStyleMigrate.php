<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ArtStyleMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'artStyleId' => [
                'type' => 'int', 
                'auto_increment' => true
            ], 
            'artStyleType' => [
                'type' => 'varchar', 
                'constraint' => 30,
            ], 
        ]); 

        $this->forge->addKey('artStyleId', true); 
        $this->forge->createTable('art_styles');
    }
    
    public function down()
    {
        $this->forge->dropTable('art_styles');
    }
}
