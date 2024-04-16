<?php


namespace services;

use models\CardAccount as Model;

class Lab2Service extends CoreServices
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new Model;
    }


    public function getAll($database): array
    {
        try {
            $this->model->setType($database);
            $start = microtime(true);
            $data = $this->model->getAll();
            $time = (round(microtime(true) - $start, 3));
        } catch (\Exception $e) {
            $time = 0.00;
            $data = [];
            $error = $e->getMessage();

        }

        return [
            'result'=> $data,
            'time' => $time,
            'error' => $error ?? '',
        ];
    }

    public function show(array $params): array
    {
        $this->checkRequiredKeys(
            $params,
            [
                'connectionType' =>'string',
                'command' => 'string',
            ],
            true,
            0
        );

//        $this->model->setType($params['connectionType']);

        try {
           $start = microtime(true);
           $this->model->query($params['command']);
           $data =  $this->model->getAllDb();
           $time = (round(microtime(true) - $start, 3));
        } catch (\Exception $e) {
           $error = $e->getMessage();
           $time = 0.00;
           $data = [];
        }

        return [
            'command' => $params['command'],
            'result' => $data,
            'connectionType' => $params['connectionType'],
            'error' => $error ?? '',
            'time' => $time,
        ];
    }




    protected function errors(): array
    {
        return [
            0 => ['code' => 1, 'message' => 'Not found required params'],
        ];
    }
}