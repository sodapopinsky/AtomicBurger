<?php namespace App\AB\Core;

use AB\Core\Exceptions\EntityNotFoundException;
abstract class EloquentRepository
{

  protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }


    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }
    public function save($data)
    {
        return $this->storeEloquentModel($data);
        /*  Following is not evaluating as expected
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
        */

    }

    public function delete($model)
    {
        return $model->delete();
    }
  
  

       public function requireById($id)
    {
        $model = $this->getById($id);

        if ( ! $model) {
            throw new EntityNotFoundException;  
        }

        return $model;
    }
   

    public function getNew($attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }
    
}