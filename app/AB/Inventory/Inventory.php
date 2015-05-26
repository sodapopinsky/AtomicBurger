<?php

namespace App\AB\Inventory;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\AB\Core\Entity;
class Inventory extends Entity {
    use SoftDeletes;

    protected $table    = 'inventory_items';
    protected $fillable = ['name','measurement','par','quantityOnHand'];

    protected $validationRules = [
        'name'      => 'required'
    ];

}