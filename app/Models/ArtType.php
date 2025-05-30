<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtType extends Model
{
    protected $table            = 'art_types';
    protected $primaryKey       = 'artTypeId';
    protected $allowedFields    = ['artType'];

    public function getArtTypes()
    {
        $db = $this->db->table('all_art_types');
        return $db->get()->getResultArray();
    }
}
