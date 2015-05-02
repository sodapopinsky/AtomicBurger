<?php  namespace App\Http\Controllers;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
class HomeController extends Controller
{
     protected function index()
    {
       		return view('index');
    }

      protected function events()
    {
       		return view('events');
    }

}
