<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtStyle extends Model
{
    protected $table            = 'art_styles';
    protected $primaryKey       = 'artStyleId';
    protected $allowedFields    = ['artStyleType'];

    public function getArtStyles()
    {
        $db = $this->db->table('all_art_styles');
        return $db->get()->getResultArray();
    }
}
