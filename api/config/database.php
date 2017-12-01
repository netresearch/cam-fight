<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 30.11.17
 * Time: 16:45
 */

class Database
{
    private $host = '0.0.0.0';
    private $port = '33061';
    private $db_name = 'challenger';
    private $username = 'challenger';
    private $password = 'challenger';
    public $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->connection->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->connection;
    }
}