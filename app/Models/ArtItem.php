<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Core\Uuid;

class ArtItem extends Model
{
    protected $table            = 'art_items';
    protected $primaryKey       = 'artItemId';
    protected $allowedFields    = ['userId', 'artStyleId', 'artTypeId', 'name', 'materials', 'shortDescription', 'description', 'width', 'height', 'localOrigin', 'price', 'image'];
    protected $beforeInsert   = ['setId'];
    protected $useSoftDeletes = true;

    protected $deletedField = 'deletedAt';


    public function setId(array $data)
    {
        $data['data']['artItemId'] = (new Uuid())->uuid3();
        return $data;
    }

    public function getAllItems()
    {
        $items = $this->select("
            CONCAT(users.name, ' ',lastName) as autor, 
            artItemId, 
            image, 
            shortDescription
        ")
            ->join('users', 'users.userId = art_items.userId')
            ->orderBy('RAND()')
            ->findAll();

        return $items;
    }

    public function getItemById(String $id)
    {
        $item = $this->select("
                users.userId,
                art_items.name,
                CONCAT(users.name, ' ',lastName) as autor, 
                artItemId, 
                image, 
                CONCAT(width, 'cm x ', height, 'cm') as measurement, 
                localOrigin, 
                price, 
                artStyleType, 
                artType,
                description, 
                materials,
            ")
            ->join('users', 'users.userId = art_items.userId')
            ->join('art_styles', 'art_items.artStyleId = art_styles.artStyleId')
            ->join('art_types', 'art_items.artTypeId = art_types.artTypeId')
            ->find($id);
        return $item;
    }
}
