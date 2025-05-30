<?php

namespace App\RulesValidation; 

class FileCustomRules
{
    public function required_files(array $files = []): bool
    {
        if(empty($files) || $files[0] === "") {
            return false;
        }
        return true;
    }
}