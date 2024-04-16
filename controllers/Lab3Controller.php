<?php


namespace controllers;

use services\Lab3Service as Service;

/**@property Service $service**/

class Lab3Controller extends BaseController
{
    public function getServiceName(): string
    {
        return Service::class;
    }

    public function index()
    {

    }
}