<?php

Route::get('/tools/meatcalculator', 'ToolsController@meatCalculator');
Route::get('/calculatemeat', 'ToolsController@calculateMeat');

Route::get('/test', 'ToolsController@test');
Route::get('/sales', 'SalesController@index');
Route::get('/', 'OrderingController@index');
Route::post('/sales/deleteprojection', 'SalesController@deleteProjection');
Route::post('/sales/saveprojection', 'SalesController@saveProjection');

Route::get('/import', 'SalesController@import');

Route::get('/events', 'HomeController@events');

Route::get('/ordering', 'OrderingController@index');
Route::get('/ordering/orderform/{orderFormId}', 'OrderingController@orderForm');
Route::get('/ordering/edit/{orderFormId}', 'OrderingController@editForm');
Route::get('/ordering/addform', 'OrderingController@addForm');
Route::post('/ordering/createform', 'OrderingController@createForm');
Route::post('/ordering/deleteform/{formId}', 'OrderingController@deleteForm');
Route::post('/ordering/saveedits', 'OrderingController@saveEdits');

Route::get('inventory/adjust', 'InventoryController@index');
Route::get('/inventory/additem', 'InventoryController@additem');
Route::post('/inventory/doadjust/{inventoryId}', 'InventoryController@doAdjust');
Route::post('/inventory/doadditem', 'InventoryController@doAddItem');
Route::get('/inventory/{inventoryId}', 'InventoryController@objectDetail');

Route::get('/employees', 'EmployeesController@index');
Route::get('/employees/profile/{employeeId}', 'EmployeesController@employeeProfile');
Route::post('/employees/delete/{employeeId}', 'EmployeesController@deleteEmployee');

Route::get('/employees/create', 'EmployeesController@getCreateEmployee');
Route::post('/employees/create', 'EmployeesController@putCreateEmployee');
//should these be restful endpoints for cross platform stuff?... api/writeup/create?
Route::post('/delete/writeup/{id}', 'EmployeesController@deleteWriteUp');
Route::post('/insert/writeup', 'EmployeesController@insertWriteUp');

Route::get('/api/meatcount', 'APIController@meatCount');

