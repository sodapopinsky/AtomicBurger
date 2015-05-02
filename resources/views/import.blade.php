<?php
use Carbon\Carbon;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
       

$path = public_path() . "/import.csv";


$row = 1;
if (($handle = fopen($path, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        $object = new ParseObject("Sales");

        	$dt = Carbon::createFromFormat('m/d/Y', $data[0] );
        		
        	$object->date = $dt;
        	$object->am = floatval($data[1]);
        	$object->pm = floatval($data[2]);


        

        	$object->save();
        
        
    }
    fclose($handle);
}


?>