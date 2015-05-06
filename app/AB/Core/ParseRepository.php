<?php namespace App\AB\Core;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Config;
abstract class ParseRepository
{
    protected $parseClass;

    public function __construct($parseClass = null)
    {      
        $this->parseClass = $parseClass;
    }

    public function initializeParse(){
        ParseClient::initialize(
            Config::get('constants.PARSE_APPID'),
            Config::get('constants.PARSE_RESTKEY'),
            Config::get('constants.PARSE_MASTERKEY'));
    }

    function getAll(){
        $query = new ParseQuery($this->parseClass);
        $query->descending("createdAt");
        $results = $query->find();
        return $results;
   }

     function getById($id){
        $query = new ParseQuery($this->parseClass);
        try {
            $results = $query->get($id);

        } catch (ParseException $ex) {
        }

       return $results;
   }

     function getByIdWithClass($id,$class){
        $query = new ParseQuery($class);
        try {
            $results = $query->get($id);

        } catch (ParseException $ex) {
        }

       return $results;
   }


   
}