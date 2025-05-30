<?php 

namespace App\Errors;

use Exception;

final class InvalidDataInputException extends Exception 
{
    private array $erros;

    public function __construct(String $message, array $errors = [])
    {
        parent::__construct($message); 
        $this->erros = $errors;
    }

    public function getErros() {
        return $this->erros; 
    }
}
