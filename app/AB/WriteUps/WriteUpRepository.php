<?php namespace App\AB\WriteUps;

use App\AB\Core\ParseRepository;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Config;

class WriteUpRepository extends ParseRepository
{

    public function __construct()
    {
        
        $this->parseClass = Config::get('constants.parseClass_WriteUps');
        $this->initializeParse();
    }

    public function getWriteUps($employee)
    {
        $query = new ParseQuery($this->parseClass);
        $query->equalTo("employee",$employee);
        $query->descending("createdAt");
        $results = $query->find();
        return $results;
    }
  
    public function deleteWriteUp($id)
    {	
    	$result = $this->getByIdWithClass($id,$this->parseClass); 
        $result->destroy();
		return;
    }
      public function insertWriteUp($writeUp, $employee)
    {   
        $object = new ParseObject($this->parseClass);
        $object->writeUp = $writeUp;
        $object->employee = $this->getById($employee);
        $object->save();
        
        return;
    }



}
