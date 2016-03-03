<?php  namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Carbon\Carbon;
use App\AB\Sales\SalesRepository;
date_default_timezone_set('America/Chicago');
class APIToolsController extends Controller
{
	private $sales;

	public function __construct(SalesRepository $sales)
	{
		$this->sales = $sales;
	}

	public function meatCount(){

        $start = Carbon::now()->subWeeks(4);
        $end = Carbon::now();
        $sales = $this->sales->getSalesForDateRange($start,$end);
        /*
    $query = new ParseQuery("SalesProjections");
    $query->greaterThan("date",Carbon::now());
    $query->lessThan("date",$end);
    $projections = $query->find();
    */
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


        foreach($sales as $item){

            $dt = Carbon::createFromFormat('Y-m-d', $item->date);
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
        //echo json_encode($inputs);
        $predictions = array();
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




            $predictions[$key] =  array("am"=>($amMax*1.1),"pm"=>($pmMax*1.1));
        }
        //echo json_encode($predictions);
        $dt = Carbon::now();
        $dow = $dt->dayOfWeek;

        if($dow == 6)
            $last = 0;
        else
            $last = $dow + 1;

        $patties = (((($predictions[$dow]["am"] + $predictions[$dow]["pm"] + $predictions[$last]["am"]) * .08) - Input::get('patties')) * .3375);

        $projection = array('thisAM' => $predictions[$dow]["am"], 'thisPM' => $predictions[$dow]["pm"],
                            'nextAM' => $predictions[$last]["am"], 'patties' => $patties, 'lbs' => $patties);




        return json_encode($projection);

/*
	$patties = Input::get('patties');
 	$patties = $patties / 2; ///forumla is for whole burgers

 	
 	$projection = $this->sales->maxProjectionsFromPeriodData(Carbon::now()->subWeeks(4), Carbon::now());


   $dt = Carbon::now();
    $dow = $dt->dayOfWeek;

    if($dow == 6)
        $last = 0;
    else
        $last = $dow + 1;
    

 	$lbs = (((($projection[$dow]["am"] + $projection[$dow]["pm"] +
 	 $projection[$last]["am"]) * .08) - $patties) * .3375);

 	$returnData = array('thisAM' => $projection[$dow]["am"], 'thisPM' => $projection[$dow]["pm"],
 		'nextAM' => $projection[$last]["am"], 'lbs' => $lbs);

 	return $returnData;
*/
 }

}
