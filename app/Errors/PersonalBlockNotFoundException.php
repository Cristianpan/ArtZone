<?php 

namespace App\Errors;

use Exception;

final class PersonalBlockNotFoundException extends Exception 
{
    public function __construct(String $message)
    {
        parent::__construct($message); 
    }
}
