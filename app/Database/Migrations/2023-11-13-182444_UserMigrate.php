<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMigrate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userId' => [
                'type' => 'varchar',
                'constraint' => 36
            ],
            'name' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'lastName' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'email' => [
                'type'       => 'varchar',
                'constraint' => 40,
            ],
            'password' => [
                'type'       => 'varchar',
                'constraint' => 60,
            ],
            'confirmed' => [
                'type' => 'tinyint',
                'default' => 0, 
            ],
            'token' => [
                'type' => 'varchar', 
                'constraint' => 32, 
            ]
        ]);

        $this->forge->addKey('userId', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
