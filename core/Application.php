<?php

namespace Core;

use \Application\Controller\ErrorController;

class Application
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action = null;

    /**
     * @var array
     */
    private $params = array();

    /**
     * Class construct
     * @param array $config
     */
    public function __construct(array $config = null)
    {
        $this->config = $config;

        $this->splitUrl();
        $this->config['module'] = $this->controller;

        $fileController = '../module/' . ucfirst($this->controller) . '/Controller/' .
            ucfirst($this->controller) . 'Controller.php';
        $classController = ucfirst($this->controller) . '\\Controller\\' . ucfirst($this->controller) . 'Controller';

        if (!$this->controller) {
            $page = new ApplicationController($this->config);
            $page->listAction();
        } elseif (file_exists($fileController)) {
            $controller = new $classController($this->config);

            if (method_exists($controller, $this->action) && is_callable(array($controller, $this->action))) {
                if (!empty($this->params)) {
                    call_user_func_array(array($controller, $this->action), $this->params);
                } else {
                    $controller->{$this->action}(null);
                }
            } elseif (strlen($this->action) == 0) {
                $this->config['module'] = 'Application';
                $controller->indexAction();
            } else {
                $this->config['module'] = 'Application';
                $page = new ErrorController($this->config);
                $page->errorAction();
            }
        } else {
            $this->config['module'] = 'Application';
            $page = new ErrorController($this->config);
            $page->errorAction();
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        $this->controller = 'Application';
        if (isset($_GET['url'])) {
            $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

            $this->controller = ucfirst($url[0]) ?? 'Application';
            $this->action     = isset($url[1]) ? $url[1] . 'Action' : null;

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            $this->params = array_values($url);
        }
    }
}
