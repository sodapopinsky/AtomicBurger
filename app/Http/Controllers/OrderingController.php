<?php namespace App\Http\Controllers;

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Illuminate\Support\Facades\Input;
class OrderingController extends BaseController {

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{

		$this->initializeParse();

		$query = new ParseQuery("orderForms");
		$query->descending("createdAt");
			$query->limit(1000);
		$results = $query->find();
		return view('ordering.index',['results' => $results]);
	}

	public function orderForm($id)
	{
		$this->initializeParse();

		$query = new ParseQuery("orderForms");
		try {
			$orderForm = $query->get($id);
  // The object was retrieved successfully.
		} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
		}


		$query = new ParseQuery("orderFormItems");
		$query->equalTo("orderForm",$orderForm);
		$query->includeKey("item");
		$results = $query->find();
		return view('ordering.orderform', ['orderForm' => $orderForm, 'results' => $results]);
	}

	public function editForm($id)
	{
		$this->initializeParse();
		$query = new ParseQuery("orderForms");
		try {
			$orderForm = $query->get($id);

		} catch (ParseException $ex) {
		}

		$query = new ParseQuery("orderFormItems");
		$query->equalTo("orderForm",$orderForm);
		$query->includeKey("item");
			$query->limit(1000);
		$orderFormItems = $query->find();
		$orderFormItemIds = array();
		foreach($orderFormItems as $item){
			array_push($orderFormItemIds,$item->item->getObjectId());
		}

		$query = new ParseQuery("inventoryObjects");
		$query->descending("createdAt");
		$query->limit(1000);
		$results = $query->find();

		return view('ordering.editform', ['orderFormItemIds' => $orderFormItemIds, 'orderForm' => $orderForm,'results' => $results]);
	}

	public function addForm()
	{
		return view('ordering.addform');
	}

	public function deleteForm($id)
	{
		$this->initializeParse();
		$query = new ParseQuery("orderForms");
		try {
			$orderForm = $query->get($id);
		} catch (ParseException $ex) {
		}

		$orderForm->destroy();
		return redirect('/ordering');
	}

	public function createForm()
	{
		$this->initializeParse();
		$item = new ParseObject("orderForms");
		$item->set("name", Input::get('formName'));
		$item->save();
		return redirect('/ordering');
	}

	public function saveEdits()
	{
		$itemId = Input::get('itemId');
		$formId =  Input::get('formId');
		$this->initializeParse();
		$query = new ParseQuery("inventoryObjects");
		try {
			$inventoryItem = $query->get($itemId);
		} catch (ParseException $ex) {
		}

		$query = new ParseQuery("orderForms");
		try {
			$orderForm = $query->get($formId);
		} catch (ParseException $ex) {

		}

		$query = new ParseQuery("orderFormItems");
		$query->equalTo("item",$inventoryItem)->equalTo("orderForm",$orderForm);
		$results = $query->find();

		if(count($results) > 0){
			foreach($results as $item){
				$item->destroy();
			}
			echo "destroyed";
		}
		else{
			$object = new ParseObject("orderFormItems");
			$object->set("item",$inventoryItem);
			$object->set("orderForm",$orderForm);
			$object->save();
			echo "saved";
		}
	}
	

}
