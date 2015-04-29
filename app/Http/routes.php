<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'InventoryController@index');
Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('inventory', 'InventoryController@index');
Route::get('/inventory/additem', 'InventoryController@additem');

Route::get('/ordering', 'OrderingController@index');
Route::get('/ordering/orderform/{orderFormId}', 'OrderingController@orderForm');
Route::get('/ordering/edit/{orderFormId}', 'OrderingController@editForm');

Route::get('/ordering/addform', 'OrderingController@addForm');
Route::post('/ordering/createform', 'OrderingController@createForm');
Route::post('/ordering/deleteform/{formId}', 'OrderingController@deleteForm');

Route::post('/ordering/saveedits', 'OrderingController@saveEdits');

Route::post('/inventory/doadjust/{inventoryId}', 'InventoryController@doAdjust');
Route::post('/inventory/doadditem', 'InventoryController@doAddItem');
Route::get('/inventory/{inventoryId}', 'InventoryController@objectDetail');

