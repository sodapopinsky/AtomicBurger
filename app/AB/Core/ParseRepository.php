<?php namespace App\AB\Core;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;

abstract class ParseRepository
{
    protected $parseClass;

    public function __construct($parseClass = null)
    {      
        $this->parseClass = $parseClass;
        $this->initializeParse();
    }

    public function initializeParse(){
        ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
        
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