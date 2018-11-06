<?php 

namespace Core;

use Core\Auth;

class SystemController
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $module;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * Class construct
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config   = $config;
        $this->module   = $config['module'] ?? 'Application';
        $this->basePath = $config['base_path'];
        $this->isAdmin  = Auth::isLoggedIn();
    }

    /**
     * @param string $view
     * @param array $data
     */
    public function view(string $view, array $data = [])
    {
        if (isset($data) && $data) extract($data);

        //including the header, the view and the footer
        require_once '../module/Application/view/layout/header.phtml';
        require_once '../module/'. $this->module . '/view/' . $view . '.phtml';
        require_once '../module/Application/view/layout/footer.phtml';
    }
    
}