<?php

namespace App\Validators;
use App\Validators\BaseValidation;

class SignupValidation extends BaseValidation
{
    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'El nombre es obligatorio.',
            'alpha_space' => 'El nombre no debe de contener caracteres especiales.',
        ],
        'email' => [
            'required' => 'El correo de usuario es obligatorio.',
            'valid_email' => 'El correo no cuenta con un formato valido.',
            'is_unique' => 'El correo ya ha sido registrado, por favor ingrese otro.',
        ]
    ];
}