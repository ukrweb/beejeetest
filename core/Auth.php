<?php

namespace Core;

class Auth
{
    /**
    * Sets all needed data to authenticate a admin
    * @param integer $adminId Id a admin
    * @return boolean true
    */
    public function createAuth(int $adminId)
    {
        return $this->setAuthSession([
            'admin_id' => $adminId,
        ]);
    }

    /**
     * Removes all session's components
     * @return boolean
     */
    public function deleteAuth()
    {
        return $this->deleteAuthSession();
    }

    /**
     * Returns is admin logged in
     * @return boolean
     */
    public static function isLoggedIn()
    {
        return self::getActiveSession();
    }

    /**
     * Returns current authentication session
     * @return string $session
     */
    private static function getActiveSession()
    {
        return (isset($_SESSION['beejeetest']['auth']) && $_SESSION['beejeetest']['auth']) ? true : false;
    }

    /**
    * Creates a session
    * @param array $session_data data for the session
    * @return boolean
    */
    private function setAuthSession(array $session_data) 
    {
        return $_SESSION['beejeetest']['auth'] = $session_data;
    }

    /**
    * Deletes a session
    * @return boolean
    */
    private function deleteAuthSession() 
    {
        unset($_SESSION['beejeetest']['auth']);
        return true;
    }
}