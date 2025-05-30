<?php

namespace App\Validators;

use App\Validators\BaseValidation;

class DataClientValidation extends BaseValidation
{
    protected $validationRules = [
        'name' => 'required',
        'lastName' => 'required',
        'email' => 'required|valid_email',
        'telephone' => 'required|regex_match[/[0-9]{10}/]',
        'card' => 'required|regex_match[/[0-9]{16}/]',
        'key' => 'required|regex_match[/[0-9]{3}/]',
        'state' => 'required',
        'street' => 'required',
        'cross' => 'required',
        'numHouse' => 'required',
        'colony' => 'required',
        'postalCode' => 'required',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'El nombre es obligatorio'
        ],
        'lastName' => [
            'required' => 'El apellido es obligatorio'
        ],
        'email' => [
            'required' => 'El correo es obligatorio', 
            'valid_email' => 'Verifique que el email tenga un formato valido'
        ],
        'telephone' => [
            'required' => 'El número de teléfono es obligatorio',
            'regex_match' => 'Verifique que el número de teléfono tenga un formato valido',
        ],
        'card' => [
            'required' => 'El número de tarjeta es obligatorio',
            'regex_match' => 'Verifique que el número de tarjeta tenga un formato valido',
        ],
        'key' => [
            'required' => 'El CVV es obligatorio',
            'regex_match' => 'Verifique que el CVV tenga un formato valido',
        ],
        'state' => [
            'required' => 'El estado es obligatorio'
        ],
        'street' => [
            'required' => 'La calle es obligatoria'
        ],
        'cross' => [
            'required' => 'Los cruzamientos son obligatorios'
        ], 
        'numHouse' => [
            'required' => 'El número de casa es obligatorio'
        ],
        'colony' => [
            'required' => 'La colonia es obligatoria'
        ], 
        'postalCode' => [
            'required' => 'El código postal es obligatorio'
        ],
    ];
}
