<?php


namespace app\interfaces;


interface ConfigInterface
{
    /**@param array $config **/
    public function setConfig(array $config):void;

    /**
     * @return array
     **/
    public function getAllConfig():array;

    /**
     * @param string $key
     * @return mixed String or Array;
     **/
    public function getRouting(string $key = ''):mixed;

}