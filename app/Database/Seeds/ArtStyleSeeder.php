<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArtStyleSeeder extends Seeder
{
    public function run()
    {
        $this->db->query('SET foreign_key_checks = 0'); 
        $this->db->table('art_styles')->truncate();
        $artStyles = [
            "Renacimiento",
            "Barroco",
            "Rococó",
            "Neoclasicismo",
            "Romanticismo",
            "Realismo",
            "Impresionismo",
            "Postimpresionismo",
            "Simbolismo",
            "Art Nouveau",
            "Fauvismo",
            "Cubismo",
            "Expresionismo",
            "Dadaísmo",
            "Surrealismo",
            "Abstracto",
            "Arte Pop",
            "Arte Conceptual",
            "Minimalismo",
            "Arte Contemporáneo"
        ];
        $artStyleToSave = [];
        foreach ($artStyles as  $artStyle) {
            $artStyleToSave[]['artStyleType'] = $artStyle;
        }

        $this->db->table('art_styles')->insertBatch($artStyleToSave);
    }
}
