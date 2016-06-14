<?php

namespace app\model\table;

use app\core\Table;

class Users extends Table
{
    protected $fields = [
        'id' => 'integer',
        'email' => 'string',
        'password' => 'string',
        'firstname' => 'string',
        'lastname' => 'string'
    ];
}