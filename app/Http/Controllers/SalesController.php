<?php  namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\AB\Sales\SalesRepository;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    private $sales;

    public function __construct(SalesRepository $sales)
    {
        $this->sales = $sales;
    }


    protected function index()
    {
       		return view('sales.index');
    }

    protected function import()
    {
       		return view('import');
    }

      protected function getSales()
      {



        $events = $this->sales->getSalesEvents(Input::get('start'),Input::get('end'));

         return json_encode($events);


    }

     protected function deleteProjection()
    {
        $id = Input::get('objectId');
        DB::table('sales_projections')->where('id', '=', $id)->delete();
        return;
    }
      protected function saveProjection()
    {
        $shift = Input::get('shift');
        $date = Input::get('start');
        $amount = Input::get('amount');
        DB::table('sales_projections')->insert(
            ['shift' => $shift,'amount' => $amount, 'date' => $date, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        );
          return;
    }

}
