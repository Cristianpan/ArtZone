<?php 

namespace App\Utils; 

class FilterHtml {
    public static function filterHtml(array $data){
        $dataFilter = []; 

        foreach ($data as $key => $value) {
            if (!is_array($value)){
                $dataFilter[$key] = htmlspecialchars(strip_tags($value));
            } else {
                $dataFilter[$key] = $value; 
            }
        }

        return $dataFilter; 
    }
}