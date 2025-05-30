<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Core\Uuid;

class PersonalBlock extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'personal_blocks';
    protected $primaryKey       = 'personalBlockId';
    protected $allowedFields    = ['userId','title', 'description', 'personalBlockId'];
}
