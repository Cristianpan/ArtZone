<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OccupationSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('SET foreign_key_checks = 0'); 
        $this->db->table('occupations')->truncate();
        $options = [
            'Pintor', 'Escultor', 'Ilustrador', 'Diseñador Gráfico', 'Fotógrafo',
            'Artista Digital', 'Artista Textil'
        ];

        $occupations = [];
        foreach ($options as $value) {
           $occupations[]['occupationType'] = $value;
        }

        $this->db->table('occupations')->insertBatch($occupations); 
    }
}
