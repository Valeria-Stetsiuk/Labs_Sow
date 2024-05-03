<?php
namespace controllers;

use app\App;
use app\Router;
use services\Lab3Service as Service;

/**
 * @property Service $service
 **/
class Lab4Controller extends BaseController
{

    public function getServiceName(): string
    {
        return Service::class;
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetAll()
    {
        $this->renderAjax('', $this->service->getData());
    }

    public function actionCreate()
    {

        $request = App::request()->post();
        $data = $this->service->create($request);

        return $this->renderAjax('',$data['data']);
    }

    public function actionUpdate()
    {
        $id = App::request()->get('id');
        $data = App::request()->post();
        $result = $this->service->update(array_merge(['id' => $id], $data));
        return $this->renderAjax('', $result['data']);
    }

    public function actionDelete()
    {
        $request = App::request()->get();

        $result = $this->service->deleteById($request);
        return $this->renderAjax('', $result['data']);
    }
}