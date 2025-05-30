<?php 

namespace App\Errors;

use Exception;

final class UnauthorizedActionException extends Exception 
{
    public function __construct(String $message)
    {
        parent::__construct($message); 
    }
}