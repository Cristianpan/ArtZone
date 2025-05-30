<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDetails extends Model
{
    protected $table            = 'userdetails';
    protected $primaryKey       = 'userDetailId';
    protected $returnType       = 'array';
    protected $allowedFields    = ['userId', 'imageProfile', 'imageBackground', 'occupationId', 'description', 'cardNumber'];

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
