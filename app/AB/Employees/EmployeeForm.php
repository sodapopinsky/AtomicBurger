<?php namespace App\AB\Employees;

use App\AB\Core\FormModel;

class EmployeeForm extends FormModel
{
    protected $validationRules = [
        'firstName'           => 'required',
        'lastName'         => 'required',
    ];


}
