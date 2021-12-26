<?php

namespace src;

class Db
{
    /**
     * @var \PDO db instance
     */
    protected static $db;

//    /**
//     * @var string name of command - SELECT, UPDATE, INSERT, DELETE
//     */
//    private string $command;
//
//    /**
//     * @var array<string> list of fields
//     */
//    private $fields = [];
//
//    /**
//     * @var array<string> conditions for WHERE
//     */
//    private $conditions = [];
//
//    /**
//     * @var string table name from
//     */
//    protected $table;

//    public function __construct()
//    {
//        $this->connectDb();
//    }

    public static function connectDb()
    {
        // if connection is already established do nothing
        if(isset(self::$db)) {
            return;
        }

        // get config from file
        $config = require 'config/db.php';

        extract($config); // extract vars from config file

        // get string to PDO connect
        $dns = $config['driver'] .
            ':host=' . $config['host'] .
            ((!empty($config['port'])) ? (';port=' . $config['port']) : '') .
            ';dbname=' . $config['dbname'];

        // try to connect
        try {
            self::$db = new \PDO($dns, $config['user'], $config['password']);
        } catch (\PDOException $e) {
            die('Cannot connect to db: ' . $e->getMessage());
        }
    }

    /**
     * execute sql string
     *
     * @param $sql string sql string to execute
     */
    public static function query(string $sql, $params = null)
    {
        if(!$sql) return false;
        if (!self::$db) {
//            if(IS_DEV) throw new \Exception('Db connection is failed!');
            return false;
        }

        $stmt = self::$db->prepare($sql);
        $stmt->execute($params);

        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//        print_r( !empty($res) ? $res : self::$db->lastInsertId());

        return !empty($res) ? $res : self::$db->lastInsertId();
    }
}