<?php

use app\core\Route;
use app\core\Configure;
use app\core\Database;

require_once 'core/functions.php';

Configure::load('app/config.php');

Database::getInstance();

try{
    Route::start();
} catch (\Exception $e) {
    Route::error($e->getMessage());
}