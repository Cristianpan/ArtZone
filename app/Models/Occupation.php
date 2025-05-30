<?php

namespace App\Models;

use CodeIgniter\Model;

class Occupation extends Model
{
   
    protected $table            = 'occupations';
    protected $primaryKey       = 'occupationId';
    protected $returnType       = 'array';
    protected $allowedFields    = ['occupationType'];
}
