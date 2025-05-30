<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainTestSeeder extends Seeder
{
    public function run()
    {
        $this->call('OccupationSeeder');
        $this->call('ArtStyleSeeder');
        $this->call('ArtTypeSeeder');
    }
}
