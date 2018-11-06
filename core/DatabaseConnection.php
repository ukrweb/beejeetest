<?php

namespace Core;

use PDO;

class DatabaseConnection
{
    /**
     * @var DatabaseConfiguration
     */
    private $configuration;

    /**
     * Class construct
     * @param DatabaseConfiguration $config
     */
    public function __construct(DatabaseConfiguration $config)
    {
        $this->configuration = $config;
    }

    public function getConnection()
    {
        return (
            new PDO(
                $this->configuration->getDSN(),
                $this->configuration->getUsername(),
                $this->configuration->getPassword(), 
                $this->configuration->getOptions()
            )
        );
    }
}