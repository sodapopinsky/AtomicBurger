<?php
use Illuminate\Support\Facades\Input;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Carbon\Carbon;

   ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
    
    
    $shift = Input::get('shift');
      $start = Input::get('start');
       $amount = Input::get('amount');

    $query = new ParseQuery("SalesProjections");
	$query->equalTo("shift",$shift);

	$results=$query->find();
	
	$start = Carbon::createFromFormat('Y-m-d', $start);
	 $object = new ParseObject("SalesProjections");
	 $object->set("shift",$shift);
	 $object->set("date",$start);
	 $object->set("amount",intval($amount));
	 $object->save();

?>