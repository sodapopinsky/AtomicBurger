<?php  namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\AB\Sales\SalesRepository;

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
       		return view('deleteprojection');
    }
      protected function saveProjection()
    {
          return view('saveprojection');
    }

}
