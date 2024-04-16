<?php


namespace services;

use models\TransportLab as Model;

class Lab3Service extends CoreServices
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Model;
    }


    protected function errors(): array
    {
       return [
           0 => ['code' => 0, 'message' => 'Error'],
       ];
    }
}