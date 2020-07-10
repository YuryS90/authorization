<?php

require "vendor/autoload.php";

use Core\Config;
use TexLab\MyDB\Runner;
use TexLab\MyDB\DB;

class MyRunner extends Runner
{
    protected function errorHandler(array $error)
    {
        echo $error["error"] . "\n";
        echo $error["sql"] . "\n";
    }
}

$runner = new MyRunner(DB::Link([
    'host' => Config::MYSQL_HOST,
    'username' => Config::MYSQL_USER_NAME,
    'password' => Config::MYSQL_PASSWORD,
]));

foreach (explode(";", file_get_contents('install/login_form.sql')) as $value) {
    try {
        if (!empty($value)) {
            $runner->runSQL($value);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}