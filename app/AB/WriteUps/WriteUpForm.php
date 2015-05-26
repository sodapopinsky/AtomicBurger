<?php namespace App\AB\WriteUps;

use App\AB\Core\FormModel;

class WriteUpForm extends FormModel
{
    protected $validationRules = [
        'writeUp'           => 'required',
        'employee'         => 'required|integer',
    ];


}
