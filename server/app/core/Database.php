<?php

class Database
{
    private static $instance = null;
    private $connection;
    private $host = 'localhost';
    private $dbName = 'gestaodemanda';
    private $username = 'postgres';
    private $password = '123';
    private $charset = 'utf8';

    private function __construct()
    {
        try {
            $dsn = "pgsql:host={$this->host};dbname={$this->dbName};options='--client_encoding={$this->charset}'";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public static function getConnection()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}