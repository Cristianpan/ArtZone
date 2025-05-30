<?php

namespace App\Validators;

use App\Errors\InvalidDataInputException;
use App\Validators\BaseValidation;

class LoginValidation extends BaseValidation
{
    protected $validationRules = [
        'email' => 'required|valid_email', 
        'password' => 'required',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'El correo de usuario es obligatorio', 
            'valid_email' => 'El correo no cuenta con un formato valido.'
        ], 
        'password' => [
            'required' => 'La contraseña es obligatoria', 
        ]
    ];

    public function validateCredentials($user, $password)
    {
        if(!$user || !password_verify($password, $user["password"])) {
            $this->validator->setError('credentials', "El usuario y/o contraseña son incorrectos"); 
            throw new InvalidDataInputException('Usuario y/o contraseña incorrectos', $this->validator->getErrors()); 
        }
        return true;
    }
}
