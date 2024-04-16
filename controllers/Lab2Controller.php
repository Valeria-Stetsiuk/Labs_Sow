<?php

/**@property Service $service**/

namespace controllers;

use app\App;
use app\Request;
use app\Router;
use services\Lab2Service as Service;

/**@property Service $service**/

class Lab2Controller  extends BaseController
{
    private $default_database = 'pdo';

    public function getServiceName(): string
    {
        return Service::class;
    }


    public function actionIndex()
    {
        try {
            $data =  $this->service->getAll($this->default_database);
        } catch ( \Exception $e) {
            $error = $e->getMessage();
        }

        return $this->render(
            'index',
            [
                'connectionType' => mb_strtolower($this->default_database),
                'result' => $data['result'] ?? [],
                'time'   => $data['time'] ?? 0,
                'error'  => $error ?? '',
            ]
        );

    }

    public function actionQuery()
    {
        if (!App::request()->isPost()) {
            Router::redirectTo('/');
        }

        $params = App::request()->post();

        if (empty($params['command'])) {
             $this->default_database = mb_strtolower($params['connectionType']);
             return $this->actionIndex();
        }

        try {
            $data = $this->service->show($params);
        } catch (\Exception $e) {
            $data['error'] = $e->getMessage();
        }
//        dd($data);
        $this->render(
            'index',
            [
                'result' => [],
                'all_db' => $data['result'],
                'time'   => $data['time'] ?? 0,
                'error'  => $data['error'] ?? '',
                'connectionType' => mb_strtolower($data['connectionType'] ?? $this->default_database),
                'command' => $data['command'] ?? '',
            ]
        );

    }


}