<?php

namespace app\render;

use app\App;

class Render {

    private $_builder;
    private string $path_view_controller;
    private string $path_view_file;
    private string $path_layout_file;

    /**
     * @param string $layout
     * @param array $data_render_array_controller
     * @param string $page - view file
     */
    public function __construct(PageBuilder $builder)
    {
        $this->_builder = $builder->buildPage();
    }

    /**
     * @return void*
     */
    public function render():void
    {
        /**@var PageBuilder $obj **/
        $obj = new PageBuilder();
        $obj->setDataObject($this->_builder)
            ->setTitle(mb_strtolower(App::getRouter()->getNameAction()))
            ->setTemplateClass(App::getConfig()->getClassRenderView())
            ->renderPage()
            ->render();
    }

    /**
     * @param array $data
     * @param string $page
     */
    public function renderAjaxPage()
    {

        $this->_checkViewFile($this->_builder->template_name);
        $obj = new PageBuilder();
        $obj->setDataObject($this->_builder)
            ->setPageTemplate($this->path_view_file)
            ->setScripts(App::getConfig()->getAvailableResources('js'))
            ->setStyle(App::getConfig()->getAvailableResources('css'))
            ->setTemplateClass(Template::class)
            ->renderPage()
            ->renderAjaxPage();
    }

    public function renderAjax()
    {
        header('Content-Type: application/json; charset=utf-8');
        header(sprintf('HTTP/1.1 %s' ,$this->_builder->statusCode));
        echo json_encode($this->_builder->variable ?? '');
        exit();
    }

    public function renderXml()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><xml/>');

        foreach ($this->_builder->variable ?? [] as $value) {
            $track = $xml->addChild('items');
            foreach ($value as $key_item => $value_item) {
                $track->addChild($key_item, htmlspecialchars($value_item)); // Для безопасности экранируем спецсимволы
            }
        }
        Header('Content-type: text/xml');
        echo $xml->asXML();
        exit();
    }

}
?>