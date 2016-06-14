<?php

namespace app\core;

class TableRegistry
{
    private static $tables = [];

    public static function get($tableName)
    {
        if (!isset(self::$tables[$tableName])) {
            $fullName = '\\app\\model\\table\\'. $tableName;
            self::$tables[$tableName] = new $fullName;
        }

        return  self::$tables[$tableName];
    }
}
