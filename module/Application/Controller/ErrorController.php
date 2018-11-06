<?php

namespace Application\Controller;

use Core\SystemController;

class ErrorController extends SystemController
{
    /**
     * Class construct
     * @param array $config
     */
    public function __construct(array $config = null)
    {
        $this->config   = $config;
        $this->module   = 'Application';
        $this->basePath = $config['base_path'];
    }

    /**
     * Error Action controller
     */
    public function errorAction()
    {
        // load views
        $this->view('error/index');
    }
}