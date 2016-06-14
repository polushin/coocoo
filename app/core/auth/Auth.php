<?php

namespace app\core\auth;

use app\core\Database;
use app\core\Hashier;

class Auth
{
    protected $config = [
        'table' => 'users',
        'loginField' => 'login',
        'passwordField' => 'password'
    ];

    public function __construct($config = [])
    {
        $this->db = Database::getInstance()->getConnection();
        $this->config = array_merge($this->config, $config);
    }

    public function getUser()
    {
        return isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
    }

    public function setUser($userData)
    {
        $_SESSION['auth'] = $userData;
    }

    public function check($email, $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        $users = $stmt->fetchAll();

        if (empty($users)) {
            return false;
        }

        $userData = reset($users);

        if (Hashier::encode($password) == $userData[$this->config['passwordField']]) {
            $this->setUser($userData);
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['auth']);
    }
}