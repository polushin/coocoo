<?php

namespace app\model\entity;

use app\core\Entity;

class User extends Entity
{
    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}