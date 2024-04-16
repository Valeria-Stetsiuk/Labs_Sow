<?php


namespace app;

use app\Config\Config;
use Josantonius\Session\Facades\Session;

class StaticFactoryApp
{
    public static function build(string $type_obj)
    {
        switch ($type_obj) {
            case 'config':
                /** @var Config **/
                return Config::getInstance();
            case 'router':
                /**@var Router **/
                return new Router();
            case 'request':
                return new Request();
            default:
                throw_if(true, 'Type not found');
        }
    }
}