<?php

use Parse\ParseClient;

ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
use Parse\ParseObject;
use Parse\ParseQuery;

$query = new ParseQuery("inventoryObjects");
try {
  $inventoryItem = $query->get($itemId);
  // The object was retrieved successfully.
} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
}

$query = new ParseQuery("orderForms");
try {
  $orderForm = $query->get($formId);
  // The object was retrieved successfully.
} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
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


?>