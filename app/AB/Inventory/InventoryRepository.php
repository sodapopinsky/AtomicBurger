<?php namespace App\AB\Inventory;

use App\AB\Core\ParseRepository;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Config;
class InventoryRepository extends ParseRepository
{

    public function __construct()
    {
        $this->parseClass = Config::get('constants.parseClass_InventoryAdjustments');
        $this->initializeParse();
    }

  public function getAllAdjustments()
    {


         $query = new ParseQuery($this->parseClass);
	$query->descending("createdAt");
			$query->limit(402);
	$query->includeKey("inventoryObject");
        $results = $query->find();
        return $results;

    }
   
}
