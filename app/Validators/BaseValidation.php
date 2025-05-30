<?php

namespace App\Validators;

use App\Errors\InvalidDataInputException;

class BaseValidation
{
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $validator;

    public function  __construct()
    {
        $this->validator = \Config\Services::validation(); 
    }

    public function validateInputs($data): bool
    {
        $this->validator->setRules($this->validationRules, $this->validationMessages);
        if(!$this->validator->run($data)){
            throw new InvalidDataInputException("Alguno de los datos es incorrecto",$this->validator->getErrors()); 
        }
        return true; 
    }
}