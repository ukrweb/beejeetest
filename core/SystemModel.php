<?php

namespace Core;

class SystemModel
{
    /**
     * @var object
     */
    public $db = null;

    /**
     * @var array
     */
    protected $config = null;

    /**
     * Class construct
     * @param array $config
     */
    function __construct(array $config)
    {
        $this->config = $config;
        try {
            self::openDatabaseConnection();
        } catch (\PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Open the database connection with the credentials from config/local.php
     */
    private function openDatabaseConnection()
    {
        extract($this->config['beejeetest']);
        $config = new DatabaseConfiguration($dsn, $username, $password, $options);

        $connection = new DatabaseConnection($config);
        $this->db = $connection->getConnection();
    }
}