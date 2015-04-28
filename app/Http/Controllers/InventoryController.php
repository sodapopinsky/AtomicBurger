<?php namespace App\Http\Controllers;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Illuminate\Support\Facades\Input;
class InventoryController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('inventory.index');
	}

	public function objectDetail($id)
	{
		return view('inventory.adjust', ['id' => $id]);

	}

	public function additem()
	{
return view('inventory.additem');

}

public function doAddItem()
	{



		ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');

		$item = new ParseObject("inventoryObjects");
	

		$item->set("name", Input::get('itemname'));
		$item->set("measurement", Input::get('itemmeasurement'));
		$item->save();
		return redirect('/inventory');

	}


	public function doAdjust($id)
	{



		ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');

		$query = new ParseQuery("inventoryObjects");
		try {
			$result = $query->get($id);

  // The object was retrieved successfully.
		} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
		}

		$result->set("quantityOnHand", intval(Input::get('quantity')));
		$result->save();
		return redirect('/inventory');

	}

}
