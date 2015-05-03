<?php
use Illuminate\Support\Facades\Input;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
   ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
    
     $id = Input::get('objectId');
    $query = new ParseQuery("SalesProjections");
		try {
			$result = $query->get($id);
		} catch (ParseException $ex) {
		}

$result->destroy();

?>