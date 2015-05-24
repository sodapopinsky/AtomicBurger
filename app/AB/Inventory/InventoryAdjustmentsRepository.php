<?php namespace App\AB\Inventory;

use App\AB\Core\ParseRepository;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseClient;
use Config;
class InventoryAdjustmentsRepository extends ParseRepository
{

    public function __construct()
    {
        $this->parseClass = Config::get('constants.parseClass_InventoryAdjustments');
        $this->initializeParse();
    }

   
}
