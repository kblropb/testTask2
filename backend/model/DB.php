<?php

namespace backend\model;

use PDO;

class DB
{
    const HOST = 'localhost';
    const NAME = 'testTask2';
    const USER = 'root';
    const PASSWORD = 'root';
    const CHARSET = 'utf8mb4';

    /** @var PDO */
    private static $db;

    /**
     * DB constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return PDO
     */
    public static function connect()
    {
        if (self::$db) {
            return self::$db;
        }

        try {
            self::$db = new PDO(
                'mysql:host=' . self::HOST . ';dbname=' . self::NAME . ';charset=' . self::CHARSET,
                self::USER,
                self::PASSWORD,
                [
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (\PDOException $e) {
            die('Unable to connect. ' . $e->getMessage());
        }

        return self::$db;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
