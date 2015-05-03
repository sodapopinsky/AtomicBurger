<?php  namespace App\Http\Controllers;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class ToolsController extends BaseController
{
     protected function meatCalculator()
    {
       		return view('tools.meatcalculator');
    }


     protected function calculateMeat()
    {
    	//calculate expected sales
$this->initializeParse();
$start = Carbon::now()->subWeeks(4);
$end = Carbon::now();

$query = new ParseQuery("Sales");
$query->greaterThan("date",$start);
$query->lessThan("date",$end);
$results = $query->find();
	
	/*
$query = new ParseQuery("SalesProjections");
$query->greaterThan("date",Carbon::now());
$query->lessThan("date",$end);
$projections = $query->find();
*/
    	$inputs = array(
		0=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),
			
		1=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),

		2=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),

		3=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),

		4=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),

		5=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),

		6=>array(
			"am"=>array("sum"=>0,"count"=>0),
			"pm"=>array("sum"=>0,"count"=>0)),
		);
	

	foreach($results as $item){
	
		$dt = Carbon::instance($item->date);
		$dow = $dt->dayOfWeek;

		$am = $inputs[$dow]["am"];
		if($item->am > 100){  //throw away low outliers
		$am["count"] = $am["count"] + 1;
		$am["sum"] = $am["sum"] + $item->am; 
		$inputs[$dow]["am"] = $am;
		}
		if($item->pm > 100){
		$pm = $inputs[$dow]["pm"];
		$pm["count"] = $pm["count"] + 1;
		$pm["sum"] = $pm["sum"] + $item->pm; 
		$inputs[$dow]["pm"] = $pm;
		}
		//todo:  filter to only last 4 weeks


	}
$predictions = array();
foreach($inputs as $key=>$value){
	$am = $value["am"];
	if($am['count']>0)
	$amAverage = $am['sum'] / $am['count'];
	else
	$amAverage = 0;
	
	$pm = $value["pm"];
	if($pm['count']>0)
	$pmAverage = $pm['sum'] / $pm['count'];
	else
	$pmAverage = 0;

	$predictions[$key] =  array("am"=>$amAverage,"pm"=>$pmAverage);
}

$dt = Carbon::now();
$dow = $dt->dayOfWeek;
if($dow == 6)
	$last = 0;
else
	$last = $dow + 1;

$patties = (((($predictions[$dow]["am"] + $predictions[$dow]["pm"] + $predictions[$last]["am"]) * .08) - Input::get('patties')) * .3375);

$projection = array('thisAM' => $predictions[$dow]["am"], 'thisPM' => $predictions[$dow]["pm"],
 'nextAM' => $predictions[$last]["am"], 'patties' => $patties);




       		return json_encode($projection);
    }


}
