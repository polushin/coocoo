<?php

namespace app\core;

class Hashier{

    public static function encode($text)
    {
        return md5($text);
    }
}