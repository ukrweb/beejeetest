<?php

/**
 * Configuration file
 */
return array(
    /** Projec Name */
    'project_name' => 'Beejeetest',

    /** Beejeetest base path */
    'base_path' => 'http://beejeetest/',

    /** Beejeetest DB settings */
    'beejeetest' => array(
        /** connection settings */
        'driver'   => 'Pdo',
        'dsn'      => 'mysql:host=localhost;dbname=beejeetest;charset=utf8mb4',
        'username' => 'root',
        'password' => 'root123',
        'options'  => array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ),
    ),

    /** Beejeetest modules */
    'modules' => array(
        'Admin',
        'Application',
        'Task',
    ),
);