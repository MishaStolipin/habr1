<?php

namespace App\Repository;


abstract class CoreRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */

    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function starConditions()
    {
        return clone $this->model;
    }
}


