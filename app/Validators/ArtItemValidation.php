<?php

namespace App\Validators;
use App\Validators\BaseValidation;

class ArtItemValidation extends BaseValidation
{
    protected $validationRules = [
        'artItemFile' => 'required_files',
        'artStyleId' => 'required|integer',
        'artTypeId' => 'required|integer',
        'name' => 'required',
        'materials' => 'required',
        'shortDescription' => 'required',
        'description' => 'required',
        'localOrigin' => 'required', 
        'price' => 'required|numeric'
    ];

    protected $validationMessages = [
        'artItemFile' => [
            'required_files' => "La imagen de la obra es obligatoria" 
        ],
        'artStyleId' => [
            'required' => 'La selección de estilo es obligatoria',
            'integer' => 'No existe el tipo de estilo',
        ],
        'artTypeId' => [
            'required' => 'El selección de tipo es obligatoria',
            'integer' => 'No existe el tipo de arte',
        ],
        'name' => [
            'required' => 'El nombre de la obra es obligatorio',
        ],
        'materials' => [
            'required' => 'El material utilizado es obligatorio',
        ],
        'shortDescription' => [
            'required' => 'La descripción corta es obligatoria',
        ],
        'description' => [
            'required' => 'La descripción es obligatoria',
        ],
        'price' => [
            'required' => 'El precio de la obra es obligatorio',
            'numeric' => 'El formato introducido no es correcto',
        ],
        'width' => [
            'required' => 'La medida del ancho de la obra es obligatoria',
            'numeric' => 'El formato introducido no es correcto',
        ],
        'height' => [
            'required' => 'La medida del alto de la obra es obligatoria',
            'numeric' => 'El formato introducido no es correcto',
        ],
        'localOrigin' => [
            'required' => 'El lugar de origen es obligatorio',
        ],
    ];
}