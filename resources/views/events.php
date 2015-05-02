
<?php

use Carbon\Carbon;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;



ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
//localhost:8000/events?start=1427587200&end=1431216000
//$start = '2015-04-26';

function nostradamus($results){
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


	return $predictions;
}




$start = Carbon::createFromTimeStamp(Input::get('start'));
$end = Carbon::createFromTimeStamp(Input::get('end'));


$start = '1427587200'; //Input::get('start')
$end = '1431216000';
$start = Carbon::createFromTimeStamp($start);
$end = Carbon::createFromTimeStamp($end);

$start->subWeeks(4); //for projection purposes, dig back 4 weeks
$query = new ParseQuery("Sales");
$query->greaterThan("date",$start);
$query->lessThan("date",$end);
$results = $query->find();
	

$events = array();



foreach($results as $item){

	$dt = Carbon::instance($item->date)->toDateTimeString();
	$amEvent = 
	array(
		"title"=> "AM - $" . number_format($item->am),
		"id"=>$item->getObjectId(),
		"start"=>$dt,
		"end"=>$dt,
		"className" => 'bgm-blue'
		);
	array_push($events,$amEvent);

		$pmEvent = 
	array(
		"title"=> "PM - $" . number_format($item->pm),
		"id"=>$item->getObjectId(),
		"start"=>$dt,
		"end"=>$dt,
		"className" => 'bgm-blue'
		);
	array_push($events,$pmEvent);
}



//check if enddate is greater than today, if so need to do predictions 
if($end->gt(Carbon::now())){

	$predictions = nostradamus($results);
	//$d = Carbon::createFromTimeStamp($end);
	while($end->gt(Carbon::now()->subDays(2))){
		$prediction = $predictions[$end->dayOfWeek];


		$event = 
	array(
		"title"=> "AM - $".number_format($prediction["am"]),
		"id"=>"1",
		"start"=>$end->toDateTimeString(),
		"end"=>$end->toDateTimeString(),
		"className" => 'bgm-gray'
		);
		array_push($events,$event);

		$event = 
	array(
		"title"=> "PM - $".number_format($prediction["pm"]),
		"id"=>"1",
		"start"=>$end->toDateTimeString(),
		"end"=>$end->toDateTimeString(),
		"className" => 'bgm-gray'
		);
		array_push($events,$event);
		$end->subDay(); 

	
	}

}

 echo json_encode($events);



