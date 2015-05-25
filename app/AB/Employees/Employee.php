<?php namespace App\AB\Employees;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\AB\Core\Entity;


class Employee extends Entity
{
    use SoftDeletes;

    protected $table    = 'employees';
    protected $fillable = ['firstName', 'lastName','passcode'];

     protected $validationRules = [
        'firstName'      => 'required',
        'lastName' => 'required',
        'passcode' => 'required'
    ];


}
