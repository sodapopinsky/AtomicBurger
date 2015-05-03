
<?php

use Carbon\Carbon;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;



ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
//localhost:8000/events?start=1427587200&end=1431216000
//$start = '2015-04-26';

function maxValues($results){

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
			$pm = $inputs[$dow]["pm"];
		if($item->am > $am["sum"]){  

		$am["sum"] = $item->am; 
		$inputs[$dow]["am"] = $am;
		}
		if($item->pm > $pm["sum"]){
		$pm = $inputs[$dow]["pm"];
		$pm["sum"] = $item->pm; 
		$inputs[$dow]["pm"] = $pm;
		}


		
}
	
		$predictions = array();
foreach($inputs as $key=>$value){
	$am = $value["am"];
	
	$pm = $value["pm"];
	
	$predictions[$key] =  array("am"=>($am["sum"] * 1.1),"pm"=>($pm["sum"]*1.1));
}


	return $predictions;

	
}




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

$start->subWeeks(4); //for projection purposes, dig back 4 weeks
$query = new ParseQuery("Sales");
$query->greaterThan("date",$start);
$query->lessThan("date",$end);
$results = $query->find();
	
$query = new ParseQuery("SalesProjections");
$query->greaterThan("date",Carbon::now());
$query->lessThan("date",$end);
$projections = $query->find();
	

$events = array();



foreach($results as $item){

	$dt = Carbon::instance($item->date)->toDateTimeString();
	$amEvent = 
	array(
		"title"=> "AM - $" . number_format($item->am),
		"id"=>$item->getObjectId(),
		"start"=>$dt,
		"end"=>$dt,
		"className" => 'bgm-cyan',
		"shift" => "AM",
			"editable" => false,
		"amount" => $item->am,
		"displayDate" => Carbon::instance($item->date)->toFormattedDateString()
		);
	array_push($events,$amEvent);

		$pmEvent = 
	array(
		"title"=> "PM - $" . number_format($item->pm),
		"id"=>$item->getObjectId(),
		"start"=>$dt,
		"end"=>$dt,
		"className" => 'bgm-cyan',
		"shift" => "PM",
		"amount" => $item->pm,
		"editable" => false,
		"displayDate" => Carbon::instance($item->date)->toFormattedDateString()
		);
	array_push($events,$pmEvent);

		$totalEvent = 
	array(
		"title"=> "$" . number_format($item->pm + $item->am),
		"id"=>$item->getObjectId(),
		"start"=>$dt,
		"end"=>$dt,
		"className" => 'bgm-blue',
		"shift" => "Total",
			"editable" => false,
		"amount" => ($item->am + $item->pm),
		"displayDate" => Carbon::instance($item->date)->toFormattedDateString()
		);
	array_push($events,$totalEvent);
}



//check if enddate is greater than today, if so need to do predictions 
if($end->gt(Carbon::now())){

	$predictions = maxValues($results);

	//add projections

		foreach($projections as $value){
			$dt = Carbon::instance($value->date);
			
				$event = 
	array(
		"title"=> strtoupper($value->shift) . " - $".number_format($value->amount),
		"id"=>$value->getObjectId(),
		"start"=>$dt->toDateTimeString(),
		"end"=>$dt->toDateTimeString(),
		"className" => 'bgm-orange',
		"shift" => $value->shift,
		"amount" => $value->amount,
		"editable" => true,
		"displayDate" => $dt->toFormattedDateString()
		);
		array_push($events,$event);
			
		}



	while($end->gt(Carbon::now()->subDays(1))){
		$prediction = $predictions[$end->dayOfWeek];
		$pmPrediction = $prediction["pm"];
		$amPrediction = $prediction["am"];
			$amfound = -1;
			$pmfound = -1;


		foreach($projections as $value){
			$dt = Carbon::instance($value->date);
		
			if($dt->toDateString() != $end->toDateString())
				continue;
			else {
				if($value->shift == "AM"){
					$amPrediction = $value->amount;
					$amfound = $value->amount;
				}
				if($value->shift == "PM"){
						$pmPrediction = $value->amount;
					$pmfound =  $value->amount;
				}
			
			}
			
		}
		if($amfound < 0){
		$event = 
	array(
		"title"=> "AM - $".number_format($amPrediction),
		"id"=>"1",
		"start"=>$end->toDateTimeString(),
		"end"=>$end->toDateTimeString(),
		"className" => 'bgm-gray',
		"shift" => "AM",
		"amount" => $prediction["am"],
		"editable" => true,
		"displayDate" => $end->toFormattedDateString(),
		"saveDate" => $end->toDateString()
		);
		array_push($events,$event);
		}
		if($pmfound < 0){
		$event = 
	array(
		"title"=> "PM - $".number_format($pmPrediction),
		"id"=>"1",
		"start"=>$end->toDateTimeString(),
		"end"=>$end->toDateTimeString(),
		"className" => 'bgm-gray',
		"shift" => "PM",
		"editable" => true,
		"amount" => $prediction["pm"],
		"displayDate" => $end->toFormattedDateString(),
		"saveDate" => $end->toDateString()		
		);
		array_push($events,$event);
}
			$event = 
	array(
		"title"=> "$".number_format($amPrediction + $pmPrediction),
		"id"=>"1",
		"start"=>$end->toDateTimeString(),
		"end"=>$end->toDateTimeString(),
		"className" => 'bgm-bluegray',
		"shift" => "Total",
		"editable" => false,
		"amount" => ($amPrediction + $pmPrediction),
		"displayDate" => $end->toFormattedDateString()
		
		);
		array_push($events,$event);


		$end->subDay(); 

	
	}

}

 echo json_encode($events);



