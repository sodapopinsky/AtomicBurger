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
 }

}
