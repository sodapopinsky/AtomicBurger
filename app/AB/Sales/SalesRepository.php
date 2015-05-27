<?php namespace App\AB\Sales;

use App\AB\Core\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class SalesRepository extends EloquentRepository {

    private $salesProjectionCushion = 1.15;
    private $events;

    public function __construct(Sales $model)
    {
        $this->model = $model;
        $this->events = array();
    }
    public function getSalesForDateRange($start,$end){
        $sales = $this->model->where('date', '>', $start)->where('date', '<', $end)->get();
        return $sales;
    }

    public function getSalesEvents($start, $end)
    {
        $start = Carbon::createFromTimeStamp($start);
        $end = Carbon::createFromTimeStamp($end);
        $start = Carbon::now();
        $end = Carbon::now();
        $end->addWeek();
        $start->subWeeks(4);
        $sales = $this->getSalesForDateRange($start,$end);



        /*
        $query = new ParseQuery("SalesProjections");
        $query->greaterThan("date",Carbon::now());
        $query->lessThan("date",$end);
        $projections = $query->find();
*/
        $this->appendPastSales($sales);
        if ($end->gt(Carbon::now()))
        {
            $this->appendPredictions($sales, $end);
        }
        return $this->events;
    }

    private function appendPastSales($sales)
    {
        foreach ($sales as $item)
        {
            $amEvent =
                array(
                    "title"       => "AM - $" . number_format($item->am),
                    "id"          => $item->id,
                    "start"       => $item->date,
                    "end"         => $item->date,
                    "className"   => 'bgm-cyan',
                    "shift"       => "am",
                    "editable"    => false,
                    "amount"      => $item->am,
                    "displayDate" => $item->date
                );
            array_push($this->events, $amEvent);

            $pmEvent =
                array(
                    "title"       => "PM - $" . number_format($item->pm),
                    "id"          => $item->id,
                    "start"       => $item->date,
                    "end"         => $item->date,
                    "className"   => 'bgm-cyan',
                    "shift"       => "pm",
                    "amount"      => $item->pm,
                    "editable"    => false,
                    "displayDate" => $item->date
                );
            array_push($this->events, $pmEvent);

            $totalEvent =
                array(
                    "title"       => "$" . number_format($item->pm + $item->am),
                    "id"          => $item->id,
                    "start"       => $item->date,
                    "end"         => $item->date,
                    "className"   => 'bgm-blue',
                    "shift"       => "Total",
                    "editable"    => false,
                    "amount"      => ($item->am + $item->pm),
                    "displayDate" => $item->date
                );
            array_push($this->events, $totalEvent);

        }
    }

    private function appendPredictions($sales, $end)
    {
        //add projections
            $projections = DB::table('sales_projections')->get();
                    foreach($projections as $value){
                        $dt = Carbon::createFromFormat('Y-m-d', $value->date);

                        $event =
                            array(
                                "title"=> strtoupper($value->shift) . " - $".number_format($value->amount),
                                "id"=>$value->id,
                                "start"=>$dt->toDateTimeString(),
                                "end"=>$dt->toDateTimeString(),
                                "className" => 'bgm-orange',
                                "shift" => $value->shift,
                                "amount" => $value->amount,
                                "editable" => true,
                                "displayDate" => $dt->toFormattedDateString()
                            );
                        array_push($this->events,$event);

                    }


        $predictions = $this->maxValues($sales);
        while ($end->gt(Carbon::now()->subDays(1)))
        {
            $prediction = $predictions[$end->dayOfWeek];
            $pmPrediction = $prediction["pm"];
            $amPrediction = $prediction["am"];
            $amfound = -1;
            $pmfound = -1;


            foreach($projections as $value){
                $dt = Carbon::createFromFormat('Y-m-d', $value->date);

                if($dt->toDateString() != $end->toDateString())
                    continue;
                else {
                    if($value->shift == "am"){
                        $amPrediction = $value->amount;
                        $amfound = $value->amount;
                    }
                    if($value->shift == "pm"){
                        $pmPrediction = $value->amount;
                        $pmfound =  $value->amount;
                    }

                }

            }

            if ($amfound < 0)
            {
                $event =
                    array(
                        "title"       => "AM - $" . number_format($amPrediction),
                        "id"          => "1",
                        "start"       => $end->toDateTimeString(),
                        "end"         => $end->toDateTimeString(),
                        "className"   => 'bgm-gray',
                        "shift"       => "am",
                        "amount"      => $prediction["am"],
                        "editable"    => true,
                        "displayDate" => $end->toFormattedDateString(),
                        "saveDate"    => $end->toDateString()
                    );
                array_push($this->events, $event);
            }
            if ($pmfound < 0)
            {
                $event =
                    array(
                        "title"       => "PM - $" . number_format($pmPrediction),
                        "id"          => "1",
                        "start"       => $end->toDateTimeString(),
                        "end"         => $end->toDateTimeString(),
                        "className"   => 'bgm-gray',
                        "shift"       => "pm",
                        "editable"    => true,
                        "amount"      => $prediction["pm"],
                        "displayDate" => $end->toFormattedDateString(),
                        "saveDate"    => $end->toDateString()
                    );
                array_push($this->events, $event);
            }
            $event =
                array(
                    "title"       => "$" . number_format($amPrediction + $pmPrediction),
                    "id"          => "1",
                    "start"       => $end->toDateTimeString(),
                    "end"         => $end->toDateTimeString(),
                    "className"   => 'bgm-bluegray',
                    "shift"       => "Total",
                    "editable"    => false,
                    "amount"      => ($amPrediction + $pmPrediction),
                    "displayDate" => $end->toFormattedDateString()

                );
            array_push($this->events, $event);
            $end->subDay();
        }
    }

    private function MaxValues($sales)
    {
        $inputs = array(
            0 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),

            1 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),

            2 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),

            3 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),

            4 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),

            5 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),

            6 => array(
                "am" => array("sum" => 0, "count" => 1),
                "pm" => array("sum" => 0, "count" => 1)),
        );

        foreach ($sales as $item)
        {
            $dt = Carbon::createFromFormat('Y-m-d', $item->date);
            $dow = $dt->dayOfWeek;

            $am = $inputs[$dow]["am"];
            $pm = $inputs[$dow]["pm"];
            if ($item->am > $am["sum"])
            {

                $am["sum"] = $item->am;
                $inputs[$dow]["am"] = $am;
            }
            if ($item->pm > $pm["sum"])
            {
                $pm = $inputs[$dow]["pm"];
                $pm["sum"] = $item->pm;
                $inputs[$dow]["pm"] = $pm;
            }
        }
        $predictions = array();
        foreach ($inputs as $key => $value)
        {
            $am = $value["am"];

            $pm = $value["pm"];

            $predictions[$key] = array("am" => ($am["sum"] * 1.1), "pm" => ($pm["sum"] * 1.1));
        }

        return $predictions;
    }
}
