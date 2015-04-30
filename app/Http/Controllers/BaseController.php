<?php  namespace App\Http\Controllers;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
class BaseController extends Controller
{
     protected function initializeParse()
    {
        //should store these in env vars
        ParseClient::initialize('lTfgcKzUPZjigInKO4e7VP8p81Wzb6Fe2dJy6UXV', 'AtMILpMRqk1J1v7UTD06DUTgwwlTyHivDoVaX3vT', 'CxbuOBvdBlyql2UryNYbE2x8WIJ6eq27EXYSY2T6');
        return;
    }

}
