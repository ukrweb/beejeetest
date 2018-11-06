<?php

namespace Application\Model;

use Core\SystemModel;

/**
 * Concrete class for Admin
 * Business layer for Admin object.
 */
class AdminEntity extends SystemModel
{
    /**
     * Id
     * @var integer $id
     */
    public $id;

    /**
     * Login
     * @var string $login
     */
    public $login;

    /**
     * Password
     * @var string $password
     */
    public $password;

    /**
     * Email
     * @var string $email
     */
    public $email;
}