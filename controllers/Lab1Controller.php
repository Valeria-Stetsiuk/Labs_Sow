<?php


namespace controllers;


use app\App;
use app\Router;
use services\Lab1Service as Service;

/**@property Service $service**/


class Lab1Controller extends BaseController
{
    private $default_database = 'jdbc';

    public function getServiceName(): string
    {
        return Service::class;
    }

    public function actionIndex()
    {
        try {
            $data =  $this->service->getAll();
        } catch ( \Exception $e) {
            $error = $e->getMessage();
        }

        $this->render(
            'index',
            [
                'connectionType' => '',
                'result' => $data['result'] ?? [],
                'time'   => $data['time'] ?? 0,
                'error'  => $error ?? '',
            ]
        );
    }

    public function actionQuery()
    {
        if (!App::request()->isPost()){
            Router::redirectTo('/');
        }

        $params = App::request()->post();

        try {
            $data = $this->service->show($params);
        } catch (\Exception $e) {
            $data['error'] = $e->getMessage();
        }

        $this->render(
            'index',
            [
                'result' => $data['result'] ?? [],
                'time'   => $data['time'] ?? 0,
                'error'  => $data['error'] ?? '',
                'connectionType' => mb_strtolower($data['connectionType'] ?? 'odbc'),
                'command' => $data['command'] ?? '',
            ]
        );
    }
}