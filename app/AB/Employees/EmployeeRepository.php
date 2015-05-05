<?php namespace App\AB\Employees;

//use AB\Core\EloquentRepository;
use AB\Employees\User;
use App\AB\Core\ParseRepository;
//use AB\Tags\TagRepository;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;

class EmployeeRepository extends ParseRepository
{

    public function __construct()
    {
        $this->parseClass = "Employees";
        $this->initializeParse();
    }

     public function createEmployee($firstName, $lastName)
    {
        $object = new ParseObject($this->parseClass);
        $object->set("firstName",$firstName);
        $object->set("lastName",$lastName);

        $object->save();
        
    }
    public function getWriteUps($employee)
    {
        $query = new ParseQuery("WriteUps");
        $query->equalTo("employee",$employee);
        $query->descending("createdAt");
        $results = $query->find();
        return $results;
    }
    public function deleteEmployee($id){
         $object = $this->getById($id);
         $object->destroy();
        return;
    }
    public function deleteWriteUp($id)
    {	
    	$result = $this->getByIdWithClass($id,"WriteUps"); ///class names should be constants in case we change table name
    	$result->destroy();
		return;
    }
      public function insertWriteUp($writeUp, $employee)
    {   
        $object = new ParseObject("WriteUps");
        $object->writeUp = $writeUp;
        $object->employee = $this->getById($employee);
        $object->save();
        
        return;
    }



}
