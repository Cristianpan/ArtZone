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


    protected function createUser(array $data){
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT); 
        $data['data']['token'] = (new Uuid())->uuid3(); 
        $data['data']['confirmed'] = 0; 

        return $data; 
    } 

    public function getUserData(String $userId){
       $userData = $this->select("
            users.userId,
            name,
            CONCAT(name, ' ',lastName) as userName, 
            imageProfile as userImage, 
            imageBackground, 
            description, 
            occupationType as occupation
        ")
        ->join('userDetails', 'userDetails.userId = users.userId', 'left')
        ->join('occupations', 'occupations.occupationId = userDetails.occupationId', 'left')
        ->find($userId);

        $userData['personalBlocks'] = (new PersonalBlock())->where('userId', $userId)->findAll();
        $userData['artItems'] = (new ArtItem())->select("
            CONCAT(users.name, ' ',lastName) as autor, 
            artItemId, 
            image, 
            shortDescription
        ") 
        ->join('users', 'users.userId = art_items.userId')
        ->where('art_items.userId', $userId)
        ->findAll();

        return $userData; 

    }
}
