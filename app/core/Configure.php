<?php

namespace app\core;

class Configure
{
    protected static $config = [];

    public static function load($configFile)
    {
        self::$config = include($configFile);
    }

    public static function get($name = null)
    {
        if (is_null($name)) {
            return self::$config;
        }

        if (isset(self::$config[$name])) {
            return self::$config[$name];
        }

        return null;
    }
}