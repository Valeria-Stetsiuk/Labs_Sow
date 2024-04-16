<?php

namespace app;

use app\config\Config;
use app\StaticFactoryApp as Factory;

class App
{

    public function __construct(array $config)
    {
        Factory::build('config')->setConfig($config);
    }

    /**
     * @return Config;
     **/
    public static function getConfig():Config
    {
        /**@var Config **/
        return Factory::build('config');
    }

    /**@var Router**/
    public static function getRouter():Router
    {
        /**@var Router**/
        return StaticFactoryApp::build('router');
    }

    /**@var Request**/
    public static function request(): Request
    {
        /**@var Request**/
        return StaticFactoryApp::build('request');
    }


    public function run()
    {
        self::getRouter()->redirectAction();
    }


}