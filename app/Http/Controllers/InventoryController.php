<?php namespace App\Http\Controllers;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;

use Illuminate\Support\Facades\Input;
class InventoryController extends BaseController {
	
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{
		$this->initializeParse();
		$query = new ParseQuery("inventoryObjects");
		$query->descending("createdAt");
		$results = $query->find();
		return view('inventory.index', ['results' => $results]);
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
