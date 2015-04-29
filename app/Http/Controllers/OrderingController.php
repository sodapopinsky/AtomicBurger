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
	public function saveEdits()
	{

		return view('ordering.saveedits', ['itemId' => Input::get('itemId'),'formId' => Input::get('formId')]);
	}
	

}
