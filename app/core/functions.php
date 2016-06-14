<?php

function h($text)
{
    $text = htmlspecialchars($text);
    $text = nl2br($text);
    return $text;
}

spl_autoload_register(function ($class) {
    $class = str_replace('\\','/', $class);
    require_once __DIR__ . "/../../" . $class . ".php";
});

session_start();
