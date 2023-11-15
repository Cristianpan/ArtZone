<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userDetailId' => [
                'type' => 'int', 
                'auto_increment' => true,
            ], 
            'userId' => [
                'type' => 'varchar', 
                'constraint' => 36, 
            ], 
            'imageProfile' => [
                'type' => 'int',
            ], 
            'imageBackground' => [
                'type' => 'int',
            ],
            'occupationId' => [
                'type' => 'int',
            ],
            'description' => [
                'type' => 'text',
            ], 
            'cardNumber' => [
                'type' => 'varchar',
                'constraint' => 60, 
            ],
        ]); 

        $this->forge->addForeignKey('userId', 'users', 'userId', 'CASCADE', 'CASCADE', "userDetails_user_FK"); 
        $this->forge->addForeignKey('occupationId', 'occupations', 'occupationId', 'NO ACTION', 'NO ACTION', 'user_occupation_FK');
        $this->forge->addForeignKey('imageProfile', 'files', 'fileId', 'NO ACTION', 'NO ACTION', 'userDetails_imageProfile_FK'); 
        $this->forge->addForeignKey('imageBackground', 'files', 'fileId', 'NO ACTION', 'NO ACTION', 'userDetails_imageBackground_FK'); 
        $this->forge->addKey('userDetailId', true); 
        $this->forge->createTable('userDetails'); 
    }

    public function down()
    {
        $this->forge->dropTable('userDetails');
    }
}
