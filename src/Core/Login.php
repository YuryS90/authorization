<?php

namespace Core;

use Core\Config;
use TexLab\MyDB\DB;
use TexLab\MyDB\DbEntity;
use TexLab\MyDB\QueryBuilderTrait;

class Login
{
    private $table;

    /**
     * подключение к БД и работа с таблицей
     */
    public function __construct()
    {
        $this->table = new DbEntity(
            Config::MYSQL_TABLE,
            DB::Link([
                'host' => Config::MYSQL_HOST,
                'username' => Config::MYSQL_USER_NAME,
                'password' => Config::MYSQL_PASSWORD,
                'dbname' => Config::MYSQL_DATABASE
            ])
        );
    }

    // public function userCheck(string $login, string $password): bool
    // {
    //     $result =  !empty($this->table->runSQL(
    //         'SELECT*FROM user WHERE username="' . $login . '" AND password="' . $password . '"'
    //     ));

    //     print_r($result);
    //     return $result;
    // }


    /**
     * Выполняет запрос к БД и проверяет существование того или иного пользователя
     */
    public function userCheck2(string $login, string $password): bool
    {
        return !empty($this->table
            ->setWhere('username="' . $login . '" AND password="' . $password . '"')
            ->get()
        );
    }
}
