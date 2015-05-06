<?php namespace App\AB\Employees;

use App\AB\Core\ParseRepository;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Config;
class EmployeeRepository extends ParseRepository
{

    public function __construct()
    {
        $this->parseClass = Config::get('constants.parseClass_Employees');
        $this->initializeParse();
    }

     public function createEmployee($firstName, $lastName)
    {
        $object = new ParseObject($this->parseClass);
        $object->set("firstName",$firstName);
        $object->set("lastName",$lastName);
        $object->save();
        
    }
    
    public function deleteEmployee($id){
         $object = $this->getById($id);
         $object->destroy();
        return;
    }
   


}
