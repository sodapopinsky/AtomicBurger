<?php namespace App\Http\Controllers;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Illuminate\Support\Facades\Input;
class OrderingController extends Controller {
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
		return view('ordering.index');
	}

	public function orderForm($id)
	{
		return view('ordering.orderform', ['id' => $id]);
	}
	public function editForm($id)
	{
		return view('ordering.editform', ['id' => $id]);
	}

	public function addForm()
	{
		return view('ordering.addform');
	}

public function deleteForm($id)
	{

		ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');

		$query = new ParseQuery("orderForms");
try {
  $orderForm = $query->get($id);
  // The object was retrieved successfully.
} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
}

$orderForm->destroy();
return redirect('/ordering');

	}
public function createForm()
	{

		ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');

		$item = new ParseObject("orderForms");
	

		$item->set("name", Input::get('formName'));

		$item->save();
		return redirect('/ordering');

		//return view('ordering.createform');
	}

	public function saveEdits()
	{

		return view('ordering.saveedits', ['itemId' => Input::get('itemId'),'formId' => Input::get('formId')]);
	}
	

}
