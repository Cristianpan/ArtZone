<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArtTypeSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('SET foreign_key_checks = 0'); 
        $this->db->table('art_types')->truncate();
        
        $artTypes = [
            ['artType' => 'Pintura'],
            ['artType' => 'Escultura'], 
            ['artType' => 'Cerámica'],
            ['artType' => 'Fotografía'],
            ['artType' => 'Vidriería']
        ];

        $this->db->table('art_types')->insertBatch($artTypes);
    }
}
