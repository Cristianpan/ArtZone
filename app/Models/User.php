<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Core\Uuid;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'userId';
    protected $allowedFields    = ['userId', 'name', 'lastName', 'password', 'confirm', 'token', 'email'];

    protected $beforeInsert   = ['createUser'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    protected function createUser(array $data){
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT); 
        $data['data']['token'] = (new Uuid())->uuid3(); 
        $data['data']['confirmed'] = 0; 

        return $data; 
    } 
}