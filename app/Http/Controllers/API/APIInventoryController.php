<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AB\Inventory\InventoryRepository;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
class APIInventoryController extends Controller {

    /**
     * @var InventoryRepository
     */
    private $inventory;

    /**
     * @param InventoryRepository $inventory
     */
    public function __construct(InventoryRepository $inventory)
    {
        $this->inventory = $inventory;
        $this->middleware('guest');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $inventory = $this->inventory->getAll();

		return Response::json($inventory);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $arr = Input::get("objects");
		return Response::json($arr);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
