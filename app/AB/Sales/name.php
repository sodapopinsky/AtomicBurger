<?php
namespace space;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\AB\Core\Entity;

class name extends Entity {
    use SoftDeletes;

    protected $table  = 'table';
    
    protected $fillable = [];
    
    protected $validationRules = [];
}