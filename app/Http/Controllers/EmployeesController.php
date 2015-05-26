<?php namespace App\Http\Controllers;

use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\AB\Employees\EmployeeRepository;
use App\AB\WriteUps\WriteUpRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class EmployeesController extends BaseController {

	private $employees;
	private $writeUps;

	public function __construct(EmployeeRepository $employees,WriteUpRepository $writeUps)
	{

		$this->employees = $employees;
		$this->writeUps = $writeUps;
	}

	public function index()
	{


	$employees = $this->employees->getAll();

	
	return view('employees.index',['employees' => $employees]);
	}

	public function employeeProfile($id)
	{
		

		$employee = $this->employees->getById($id);
		$writeUps = $this->writeUps->getWriteUps($id);
		return view('employees.profile',['employee' => $employee, 'writeUps' => $writeUps]);
	
	}

	public function getCreateEmployee(){

		return view('employees.create');
	}
	public function deleteEmployee($id){

        $employee = $this->employees->requireById($id);
        $employee->delete();

		return redirect('/employees')->with('message','Employee Deleted');

	}

	public function putCreateEmployee(){

		$form = $this->employees->getEmployeeForm();
		if ( ! $form->isValid())
        {
            return Redirect::back()->with('errors', $form->getErrors());
        }
        $employee = $this->employees->getNew(["firstName"=>Input::get('firstName'),"lastName"=>Input::get('lastName'),"passcode"=>3]);
        if ( ! $employee->isValid()) {
             return Redirect::back()->with('errors',$employee->getErrors());
        }

        $this->employees->save($employee);

		return redirect('/employees');

	}
	public function deleteWriteUp($id)
	{
        $writeUp = $this->writeUps->requireById($id);
        $writeUp->delete();
		return Redirect::back()->with('message','Operation Successful !');
	}

	public function postWriteUp()
	{
        $form = $this->writeUps->getWriteUpForm();
        if ( ! $form->isValid())
        {
            return Redirect::back()->with('errors', $form->getErrors());
        }

        $writeUp = $this->writeUps->getNew(["writeUp"=>Input::get('writeUp'),"employee"=>Input::get('employee')]);
        if ( ! $writeUp->isValid()) {
            return Redirect::back()->with('errors',$writeUp->getErrors());
        }

        $this->writeUps->save($writeUp);
		return Redirect::back();
	}


}
