<?php


namespace controllers;

use components\SoapService;
use services\Lab3Service as Service;
use \SoapServer;
use \SimpleXMLElement;

/**@property Service $service**/

class Lab3Controller extends BaseController
{
    public function getServiceName(): string
    {
        return Service::class;
    }

    public function actionIndex()
    {
        $client = new \SoapClient(null,[
            'location' => "http://localhost/lab3/server",
            'uri'      => "http://localhost/lab3/server"
        ]);

        $response = $client->__soapCall("getData",[]);

        $this->render('index',['response' => $response]);
    }

    public function actionServer()
    {
        $options = array('uri' => 'http://localhost/lab3/server');
        $server = new SoapServer(null, $options);
        $server->setClass(SoapService::class);
        return $server->handle();
    }

    public function actionTest()
    {
//        $client = new \SoapClient(null,[
//            'location' => "http://localhost/lab3/server", // Адрес вашего SOAP-сервера
//            'uri'      => "http://localhost/lab3/server" // URI вашего SOAP-сервера
//        ]);
//
//        $response = $client->__soapCall("saveData", array());
//
//        $this->renderAjax('',$response);
//
//        exit();
    }
}