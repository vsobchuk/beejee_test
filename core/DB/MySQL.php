<?php


namespace Core\DB;


class MySQL
{
//    protected $dsn = 'mysql:host=127.0.0.1:3306;dbname=test_task';
    protected $dsn = 'mysql:host=127.0.0.1:3306;dbname=vsobchuk';
    protected $user = 'vsobchuk';
//    protected $pass = '123456';
    protected $pass = 'vsobchuk';

    protected $pdo;

    protected static $instance;

    public static function getInstance(): MySQL
    {
        if (empty(MySQL::$instance)) {
            MySQL::$instance = new MySQL;
        }

        return MySQL::$instance;
    }

    public function getPdo()
    {
        if (!$this->pdo) {
            $this->pdo = new \PDO($this->dsn, $this->user, $this->pass);
        }

        return $this->pdo;
    }
}
