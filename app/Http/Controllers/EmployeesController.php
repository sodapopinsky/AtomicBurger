<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AB\Employees\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class EmployeesController extends Controller {

 private $employees;

	 public function __construct(EmployeeRepository $employees)
    {
    	 $this->employees = $employees;

    }

	public function index()
	{
		$employees = $this->employees->getAll();
		return view('employees.index',['employees' => $employees]);
	}

	public function employeeProfile($id)
	{
		$employee = $this->employees->getById($id);
		$writeUps = $this->employees->getWriteUps($employee);
		return view('employees.profile',['employee' => $employee, 'writeUps' => $writeUps]);
	}

	public function getCreateEmployee(){

			return view('employees.create');
	}
	public function deleteEmployee($id){
		$this->employees->deleteEmployee($id);
		return redirect('/employees')->with('message','Employee Deleted');

	}

public function putCreateEmployee(){
		$this->employees->createEmployee(Input::get('firstName'),Input::get('lastName'));
		return redirect('/employees');

}
	public function deleteWriteUp($id)
	{	
		$this->employees->deleteWriteUp($id);
		return Redirect::back()->with('message','Operation Successful !');
	}

	public function insertWriteUp()
	{	
		$this->employees->insertWriteUp(Input::get('writeUp'),Input::get('employeeId'));

		return Redirect::back();
	}


}