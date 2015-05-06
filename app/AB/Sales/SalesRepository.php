<?php namespace App\AB\Sales;

use App\AB\Core\ParseRepository;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Config;
use Carbon\Carbon;
class SalesRepository extends ParseRepository
{

    private $salesProjectionCushion = 1.15; // percent cushion added to max sales projections

    public function __construct()
    {
        $this->parseClass = Config::get('constants.parseClass_Sales');
        $this->initializeParse();
    }

    public function salesForPeriod($start,$end){
        $query = new ParseQuery($this->parseClass);
        $query->greaterThan("date",$start);
        $query->lessThan("date",$end);
        $results = $query->find();
        return $results;
    }
    public function maxProjectionsFromPeriodData($start, $end)
    {    
        $results = $this->salesForPeriod($start,$end);

    $inputs = array(
        0=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),

        1=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),

        2=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),

        3=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),

        4=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),

        5=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),

        6=>array(
            "am"=>array("sum"=>0,"count"=>1),
            "pm"=>array("sum"=>0,"count"=>1)),
        );


    foreach($results as $item){

        $dt = Carbon::instance($item->date);
        $dow = $dt->dayOfWeek;

        $am = $inputs[$dow]["am"];

        if($item->am > $am["sum"]){ 
            $am["sum"] = $item->am; 
            $inputs[$dow]["am"] = $am;
        } 
        $pm = $inputs[$dow]["pm"];
        if($item->pm > $pm["sum"]){
            $pm = $inputs[$dow]["pm"];
            $pm["sum"] = $item->pm; 
            $inputs[$dow]["pm"] = $pm;
        }
    }

    $projection = array();
    foreach($inputs as $key=>$value){
        $am = $value["am"];
        if($am['count']>0)
            $amMax = $am['sum'];
        else
            $amMax = 0;

        $pm = $value["pm"];
        if($pm['count']>0)
            $pmMax = $pm['sum'];
        else
            $pmMax = 0;

        $projection[$key] =  array("am"=>($amMax*$this->salesProjectionCushion),"pm"=>($pmMax*$this->salesProjectionCushion)); 
    }
   
   return $projection;
   
}


}
