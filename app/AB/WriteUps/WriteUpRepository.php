<?php namespace App\AB\WriteUps;

use App\AB\Core\EloquentRepository;
use Config;
class WriteUpRepository extends EloquentRepository
{
    
   protected $model;
   public function __construct(WriteUp $model)
    {
        $this->model = $model;
    }

    public function getWriteUps($employeeId){
         return $this->model->where('employee', '=', $employeeId)->get();
    }

    

}
