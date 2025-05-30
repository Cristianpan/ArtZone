<?php

namespace App\Validators;
use App\Validators\BaseValidation;

class PersonalBlockValidation extends BaseValidation
{
    protected $validationRules = [
        'title' => 'required',
        'description' => 'required',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'El título es obligatorio',
        ],
        'description' => [
            'required' => 'La descripción es obligatoria',
        ],
    ];
}
