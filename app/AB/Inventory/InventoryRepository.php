<?php namespace App\AB\Inventory;

use App\AB\Core\EloquentRepository;

class InventoryRepository extends EloquentRepository
{

    protected $model;


    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }



}
