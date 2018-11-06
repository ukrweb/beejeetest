<?php

namespace Admin\Controller;

use Core\SystemController;
use Admin\Model\Admin;
use Core\Auth;

/**
 * Controller for Admin pages
 */
class AdminController extends SystemController
{
    /**
     * Index tasks page
     */
    public function indexAction()
    {
        $this->loginAction();
    }

    /**
     * Login admin page action
     */
    public function loginAction()
    {
        if (!$this->isAdmin) {
            if (isset($_POST['login'])) {
                $admin  = new Admin($this->config);
                if ($adminId = $admin->logIn($_POST['login'], $_POST['password'])) {
                    $auth = new Auth();
                    $auth->createAuth($adminId);
                    header('location: ' . $this->config['base_path']);
                } else {
                    $errorMessage = "Incorrect login or password";
                }
            }

            // load views.
            $this->view('admin/login', [
                'errorMessage' => $errorMessage ?? null
            ]);
        } else {
            header('location: ' . $this->config['base_path']);
        }
    }

    /**
     * Logout admin page action
     */
    public function logoutAction()
    {
        if ($this->isAdmin) {
            $auth = new Auth();
            $auth->deleteAuth();
        }

        header('location: ' . $this->config['base_path']);
    }
}