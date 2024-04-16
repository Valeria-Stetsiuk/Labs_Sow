<?php


namespace controllers;

use \app\render\PageBuilder;
use \app\render\Render;


abstract class BaseController
{
    public string  $layout;
    private string $path_view_file;
    private string $path_layout_file = '';
    protected $service;

    public function __construct() {
       $service = $this->getServiceName();
       if (!empty($service)) {
           $this->service = new $service;
       }
    }

    abstract public function getServiceName(): string;

    /**
     * @param string $page * - file name
     * @param array $__data_controller_array__ - data for page
     */
    public function renderAjax($page = '', array $variables = []):void
    {
        $build = new PageBuilder();
        $build->setVariable($variables);

        if (!empty($page) ) {
            $build->setPageTemplate($page);
            (new Render($build))->renderAjaxPge();
        } else {
            (new Render($build))->renderAjax();
        }
    }

    /**
     * @param string $page - $this->render('index') - file name;
     * @param array $data_controller_array
     * @return void
     **/
    public function render(string $page, array $data_controller_array = []):void
    {
        $builder = (new PageBuilder())
            ->setLayout($this->path_layout_file)
            ->setTemplateName($page)
            ->setVariable($data_controller_array);
        (new Render($builder))->render();
    }

}