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

    public function getData()
    {
        return $this->model->getAll();
    }

    public function create(array $data): array
    {
        $this->checkRequiredKeys(
            $data,
            [
                'surname' => 'str',
                'model' => 'str',
                'transport' => 'str',
                'number' => 'str'
            ],
            true,
            1
        );

        $this->model->create($data['surname'], $data['model'], $data['transport'],$data['number']);
        return ['code' => 200, 'data' => $this->getData()];
    }

    public function update(array $data)
    {

        $this->checkRequiredKeys(
            $data,
            [
                'id' => 'int',
                'surname' => 'str',
                'model' => 'str',
                'transport' => 'str',
                'number' => 'str',
                'deleted' => 'int'
            ],
            true,
            1
        );

        $this->model->updateById(
            $data['id'],
            $data['surname'],
            $data['model'],
            $data['transport'],
            $data['number'],
            $data['deleted']
        );

        return ['code' => 200, 'data' => $this->getData()];
    }

    public function deleteById(array $data): array
    {
        $this->checkRequiredKeys(
            $data,
            [
                'id' => 'int',
            ],
            true,
            1
        );
        $this->model->deleteById($data['id']);
        return ['code' => 200, 'data'=> $this->getData()];
    }

    protected function errors(): array
    {
       return [
           0 => ['code' => 0, 'message' => 'Error'],
           1 => ['code' => 400, 'message' => 'Undefined require key'],
       ];
    }
}