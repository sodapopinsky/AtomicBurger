<?php namespace App\Http\Controllers;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use App\AB\Inventory\InventoryRepository;
use Illuminate\Support\Facades\Input;


class InventoryController extends BaseController {
	
	private $inventory;
	public function __construct(InventoryRepository $inventory)
	{
		$this->inventory = $inventory;
		$this->middleware('guest');
	}

	public function index()
	{

        $inventory = $this->inventory->getAll();
		return view('inventory.index', ['results' => $inventory]);
	}

	public function objectDetail($id)
	{
		$this->initializeParse();
		$query = new ParseQuery("inventoryObjects");
		try {
			$results = $query->get($id);
		} catch (ParseException $ex) {
		}
		return view('inventory.adjust', ['results' => $results]);
	}

	public function additem()
	{
		return view('inventory.additem');
	}

		public function reports()
	{
		$results = $this->inventory->getAllAdjustments();
		return view('inventory.reports',['results' => $results]);
	}

	public function doAddItem()
	{
		$this->initializeParse();
		$item = new ParseObject("inventoryObjects");
		$item->set("name", Input::get('itemname'));
		$item->set("measurement", Input::get('itemmeasurement'));
		$item->save();
		return redirect('/inventory/adjust');
	}

	public function doAdjust($id)
	{
		$this->initializeParse();
		$query = new ParseQuery("inventoryObjects");
		try {
			$result = $query->get($id);
		} 
		catch (ParseException $ex) {
		}
		$result->set("quantityOnHand", floatval(Input::get('quantity')));
		$result->save();

		$object = new ParseObject("inventoryAdjustments");
		$object->set("inventoryObject",$result);
		$object->set("quantity",floatval(Input::get('quantity')));
		$object->save();

		return redirect('/inventory/adjust');
	}

}
