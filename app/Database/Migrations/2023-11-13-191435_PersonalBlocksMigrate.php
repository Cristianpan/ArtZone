<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PersonalBlocksMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'personalBlockId' =>[
                'type'=> 'varchar', 
                'constraint' => 36, 
            ], 
            'userId' => [
                'type' => 'varchar', 
                'constraint' => 36, 
            ],
            'title' => [
                'type' => 'varchar', 
                'constraint' => 32, 
            ], 
            'description' => [
                'type' => 'text', 
            ]
        ]);
        
        $this->forge->addKey('personalBlockId', true);
        $this->forge->addForeignKey('userId', 'users', 'userId', 'CASCADE', 'CASCADE', 'personalBlock_user_FK');

        $this->forge->createTable('personal_blocks');
    }
    
    public function down()
    {
        $this->forge->dropTable('personal_blocks');
    }
}
