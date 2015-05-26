<?php
namespace App\AB\Sales;


use App\AB\Core\Entity;

class Sales extends Entity {

    protected $table    = 'sales';
    protected $fillable = ['date', 'am','pm'];
    protected $validationRules = [
        'date'      => 'date',
        'am' => 'numeric|min:0',
        'pm' => 'numeric|min:0'
    ];
}