<?php


namespace controllers;


use services\SiteService;

/**@property SiteService $service**/

class SiteController extends BaseController
{


    public function getServiceName(): string
    {
        return SiteService::class;
    }

    public function actionIndex()
    {
        return $this->render('index',[]);
    }
}