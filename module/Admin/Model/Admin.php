<?php

namespace Admin\Model;

use Application\Model\AdminEntity;

class Admin extends AdminEntity
{
    /**
     * Login a admin
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function logIn(string $login, string $password)
    {
/*
        $sql= "SELECT id FROM admin WHERE login = :login AND password = SHA2(password(:password), 512) LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':login'    => $login,
            ':password' => $password
        ));

        return $query->rowcount() ? $query->fetch()->id : false;
*/
        return ($login == 'admin' && $password == '123') ? 1 : false;
    }
}