<?php

/**
 ** Класс конфигурации базы данных
 */
class DB
{

    const USER = "root";
    const PASS = "rootroot";
    const HOST = "db";
    const DB = "pb";

    public static function connToDB()
    {

        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        return new PDO("mysql:dbname=$db;host=$host", $user, $pass);

    }
}
