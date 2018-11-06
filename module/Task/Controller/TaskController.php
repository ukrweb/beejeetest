<?php

namespace Task\Controller;

use Core\SystemController;
use Task\Model\Task;
use Application\Controller\ErrorController;

/**
 * Controller for task pages
 */
class TaskController extends SystemController
{
    /**
     * Index tasks page
     */
    public function indexAction()
    {
        $this->listAction();
    }

    /**
     * List all tasks including sorting
     */
    public function listAction()
    {
        $task  = new Task($this->config);
        $tasks = $task->getAll();
        $amountOfTasks = $task->getAmountTasks();
        
        // load views.
        $this->view('task/list', [
            'tasks'         => $tasks,
            'amountOfTasks' => $amountOfTasks
        ]);
    }

    /**
     * Add task action
     */
    public function addAction()
    {
        if (isset($_POST['submit_add_task'])) {
            $task = new Task($this->config);
            $task->addTask([
                'userName' => $_POST['username'],
                'email'    => $_POST['email'],
                'comments' => $_POST['comments']
            ]);
            header('location: ' . $this->config['base_path']);
        } else {
            // load views.
            $this->view('task/add');
        }
    }

    /**
     * Edit task action
     * @param string $taskId Id of the to edit task
     */
    public function editAction($taskId)
    {
        if ($this->isAdmin) {
            if (isset($_POST['submit_update_task'])) {
                $task = new Task($this->config);
                $task->updateTask([
                    'taskId'   => $_POST['id'],
                    'comments' => $_POST['comments'],
                    'status'   => isset($_POST['status']) && $_POST['status'] ? 1 : 0
                ]);
                header('location: ' . $this->config['base_path']);
            } elseif (isset($taskId)) {
                $task = new Task($this->config);
                $task = $task->getTask($taskId);
    
                if ($task === false) {
                    $page= new ErrorController($this->config);
                    $page->errorAction();
                } else {
                    // load views.
                    $this->view('task/edit', [
                        'task' => $task
                    ]);
                }
            } else {
                header('location: ' . $this->config['base_path']);
            }
        } else {
            header('location: ' . $this->config['base_path']);
        }        
    }
}