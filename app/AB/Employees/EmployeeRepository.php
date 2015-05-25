<?php namespace App\AB\Employees;

use App\AB\Core\EloquentRepository;
use Config;
class EmployeeRepository extends EloquentRepository
{

   protected $model;
   public function __construct(Employee $model)
    {
        $this->model = $model;
    }


    public function getEmployeeForm()
    {
        return new EmployeeForm;
    }
}
