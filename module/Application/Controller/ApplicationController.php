<?php

namespace Application\Controller;

use Core\SystemController;
use Task\Controller\TaskController;

class ApplicationController extends SystemController
{
    /**
     * Index Action controller
     */
    public function indexAction()
    {
        $this->config['module'] = 'Task';
        $page = new TaskController($this->config);
        $page->listAction();
        return;
    }
}