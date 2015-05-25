<?php namespace App\AB\WriteUps;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\AB\Core\Entity;

class WriteUp extends Entity
{
    use SoftDeletes;

    protected $table    = 'write_ups';
    protected $fillable = ['employee', 'writeUp'];


}
